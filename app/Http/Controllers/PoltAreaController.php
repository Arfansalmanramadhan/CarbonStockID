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
                "periode_pengamatan" => $periode_pengamatan, // Gabungan tanggal mulai dan berakhir
                "periode_id" => $periode->id,
                "slug" => Str::slug($validatedData['daerah']),
            ]);
            // dd($poltArea);
            // Response berhasil
            // return response()->json([
            //     'message' => 'PoltArea berhasil di buat',
            //     'data' => $poltArea
            // ], 201);
            DB::commit();
            return redirect()->back()->with('success', 'Lokasi berhasil ditambahkan!');
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
        $poltArea = PoltArea::where("slug", $slug)->first();
        // jika tidak ditemukan, kemabali erro
        if (!$poltArea) {
            return response()->json([
                "pesan" => "PoltArea tidak ditemukan"
            ]);
        }
        // Kembalikan respons JSON dengan data PoltArea
        return response()->json([
            'pesan' => 'PoltArea berhasil ditemukan ',
            'data' => $poltArea
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        // Validasi data
        $validatedData = $request->validate([
            'daerah' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
        // cari poltarean berdasarkan slug
        $poltArea = PoltArea::where("slug", $slug)->first();
        // jika tidak ditemukan, kembalikan respon error
        if (!$poltArea) {
            return response()->json([
                "pesan" => "PoltArea tidak ditemukan"
            ], 404);
        }
        // Generate slug baru berdasarkan daerah yang diperbarui
        $validatedData['slug'] = Str::slug($validatedData['daerah']);
        // Update data poltArea
        $poltArea->update($validatedData);

        // Kembalikan respons sukses
        return response()->json([
            'pesan' => 'PoltArea berhasil diperbarui',
            'data' => $poltArea
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $poltArea = PoltArea::where('slug', $slug)->first();

        if (!$poltArea) {
            return response()->json([
                'pesan' => 'PoltArea tidak ditemukan'
            ], 404);
        }

        $poltArea->delete(); // Soft delete

        return response()->json([
            'pesan' => 'PoltArea berhasil dihapus'
        ], 200);
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

        $poltArea->forceDelete(); // Hard delete

        return response()->json(['pesan' => 'PoltArea berhasil dihapus secara permanen'], 200);
    }
}
