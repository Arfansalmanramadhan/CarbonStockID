<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\PoltArea;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\PoltAreaResorce;
use Illuminate\Support\Facades\Auth;
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ambil profil berdasarkan ID yang dikirimkan dalam request
        $profileId = $request->input('profil_id'); // Pastikan profil_id dikirim dari frontend
        $profile = Profil::find($profileId);

        // $profile = $user->profil;
        if (!$profileId) {
            // Untuk debugging, periksa user dan profil
            return response()->json([
                'message' => 'Profil tidak terkirim',
                // 'profil' => $profile,
                'profil' => $profileId
            ], 404);
        }

        // Validasi request
        $validatedData = $request->validate([
            'daerah' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        try {
            // Membuat instance PoltArea baru
            $poltArea = PoltArea::create([
                "profil_id" => $profile->id,
                "daerah" => $validatedData['daerah'],
                "latitude" => $validatedData['latitude'],
                "longitude" => $validatedData['longitude']
            ]);

            // Response berhasil
            // return response()->json([
            //     'message' => 'PoltArea berhasil di buat',
            //     'data' => $poltArea
            // ], 201);
            return redirect()->back()->with('success', 'Plot area berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Response error
            return response()->json([
                'message' => 'Gagal membuat PoltArea',
                'error' => $e->getMessage()
            ], 500);
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
