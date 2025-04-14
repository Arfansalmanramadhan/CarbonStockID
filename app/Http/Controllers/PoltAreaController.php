<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\PoltArea;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\PoltAreaResorce;
use App\Models\Periode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Profiler\Profile;

class PoltAreaController extends Controller
{

    // protected $geocodingService;

    // public function __construct(GeocodingService $geocodingService)
    // {
    //     $this->geocodingService = $geocodingService;
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $poltArea = PoltArea::get();
        // return PoltAreaResorce::collection($poltArea);
        $user = Auth::user();
        $poltArea = PoltArea::where('id', $user->id)->first();
        return view('tambah.PlotArea', compact('user', 'poltArea'));
    }

    public function tambah() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $periodes = Periode::all(); // Ambil semua periode dari database
        return view('tambah.PlotArea', compact('periodes'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());
        // Validasi request
        $validatedData = $request->validate([
            'daerah' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'jenis_hutan' => 'required|string|max:255',
            'periode_pengamatan' => 'required|string',
            'periode_id' => 'required|exists:periode,id',
        ]);
        DB::beginTransaction();
        try {
            $periode = Periode::findOrFail($validatedData['periode_id']);

            $periode_pengamatan = $periode->tanggal_mulai . ' s/d ' . $periode->tanggal_berakhir;

            $poltArea = PoltArea::create([
                "daerah" => $validatedData['daerah'],
                "latitude" => $validatedData['latitude'],
                "longitude" => $validatedData['longitude'],
                "jenis_hutan" => $validatedData['jenis_hutan'],
                "periode_pengamatan" => $periode_pengamatan, // Gabungan tanggal mulai dan berakhir
                "periode_id" => $periode->id,
                "slug" => Str::slug($validatedData['daerah']),
                "tim_id" => $request->tim_id,
            ]);
            // dd($poltArea);
            // dd($poltArea);
            // Response berhasil
            // return response()->json([
            //     'message' => 'PoltArea berhasil di buat',
            //     'data' => $poltArea
            // ], 201);
            DB::commit();
            return redirect()->route('Lokasi.lokasi')->with('success', 'Lokasi berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        // cari poltArea berdasarkan slug
        $user = Auth::user();
        $lokasi = PoltArea::where("slug", $slug)->first();
        // jika tidak ditemukan, kemabali erro
        // if (!$poltArea) {
        //     return response()->json([
        //         "pesan" => "PoltArea tidak ditemukan"
        //     ]);
        // }
        // Kembalikan respons JSON dengan data PoltArea
        return view('show.Lokasi', 'lokasi', "user");
        // return response()->json([
        //     'pesan' => 'PoltArea berhasil ditemukan ',
        //     'data' => $poltArea
        // ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $user = Auth::user();
        // Cari PoltArea berdasarkan slug
        $poltArea = PoltArea::where('slug', $slug)->firstOrFail();

        // Ambil daftar periode untuk dropdown
        $periodes = Periode::all();

        return view('edit.PlotArea', compact('poltArea', 'periodes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        // Validasi request
        $validatedData = $request->validate([
            'daerah' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'jenis_hutan' => 'required|string|max:255',
            'periode_pengamatan' => 'required|string',
            'periode_id' => 'required|exists:periode,id',
        ]);

        DB::beginTransaction();
        try {
            // Cari PoltArea berdasarkan slug
            $poltArea = PoltArea::where('slug', $slug)->firstOrFail();

            // Cari Periode berdasarkan periode_id
            $periode = Periode::findOrFail($validatedData['periode_id']);

            // Gabungkan tanggal mulai dan berakhir untuk periode_pengamatan
            $periode_pengamatan = $periode->tanggal_mulai . ' s/d ' . $periode->tanggal_berakhir;

            // Pastikan slug tetap unik
            $newSlug = Str::slug($validatedData['daerah']);

            // Cek apakah slug baru sudah digunakan oleh PoltArea lain
            if (PoltArea::where('slug', $newSlug)->where('id', '!=', $poltArea->id)->exists()) {
                return redirect()->back()->with('error', 'Slug sudah digunakan, coba nama daerah lain.');
            }

            // Update data PoltArea
            $poltArea->update([
                "daerah" => $validatedData['daerah'],
                "latitude" => $validatedData['latitude'],
                "longitude" => $validatedData['longitude'],
                "jenis_hutan" => $validatedData['jenis_hutan'],
                "periode_pengamatan" => $periode_pengamatan,
                "periode_id" => $periode->id,
                "slug" => $newSlug, // Update slug dengan yang baru
            ]);
            dd($poltArea);
            DB::commit();
            return redirect()->route('Lokasi.lokasi', ['slug' => $slug])->with('success', 'Lokasi berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $poltArea = PoltArea::find($id);
            $poltArea->delete(); // Soft delete
            DB::commit();
            return redirect()->back()->with('success', 'PoltArea berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'PoltArea tidak ditemukan.');
        }
    }
    public function restore($slug)
    {
        // Cari poltArea yang sudah dihapus dengan soft delete
        $poltArea = PoltArea::withTrashed()->where('slug', $slug)->first();

        if (!$poltArea) {
            return response()->json([
                'pesan' => 'PoltArea tidak ditemukan atau belum dihapus'
            ], 404);
        }

        // Pulihkan data yang telah dihapus
        $poltArea->restore();

        return response()->json([
            'pesan' => 'PoltArea berhasil dipulihkan',
            'data' => $poltArea
        ], 200);
    }
    public function indexx()
    {
        $poltAreas = PoltArea::withTrashed()->get();

        return PoltAreaResorce::collection($poltAreas);
    }
    public function trashed()
    {
        $poltAreas = PoltArea::onlyTrashed()->get();

        return response()->json([
            'pesan' => 'Daftar PoltArea yang telah dihapus',
            'data' => $poltAreas
        ], 200);
    }
    public function forceDelete($slug)
    {
        $poltArea = PoltArea::withTrashed()->where('slug', $slug)->first();

        if (!$poltArea) {
            return response()->json(['pesan' => 'PoltArea tidak ditemukan'], 404);
        }

        $poltArea->delete(); // Hard delete

        return response()->json(['pesan' => 'PoltArea berhasil dihapus secara permanen'], 200);
    }
}
