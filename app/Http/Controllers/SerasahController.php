<?php

namespace App\Http\Controllers;

use App\Http\Resources\SerasahResource;
use App\Models\Profil;
use App\Models\PoltArea;
use App\Models\Semai;
use App\Models\Serasah;
use App\Models\SubPlot;
use App\Models\Tanah;
use App\Models\TumbuhanBawah;
use Illuminate\Http\Request;
use App\Models\Zona;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class SerasahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $serasah = Serasah::get();
        // return SerasahResource::collection($serasah);
        $user = Auth::user();
        $poltArea = PoltArea::where('id', $user->id);
        $zona = Zona::where('polt-area_id', $user->id);
        $serasah = Serasah::where('zona_id');
        return view('tambah.PlotA', compact('user', 'poltArea', 'zona', 'serasah'));
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


    // public function store(Request $request)
    // {
    //     // $poltareaID = $request->input("polt-area_id");
    //     // dd($poltareaID);
    //     // ambil poltArea berdasarkan id
    //     $poltareaID = $request->input("polt-area_id"); // pastikan polt-area_id dikirim dari FE
    //     $polt = PoltArea::find($poltareaID);
    //     if (!$poltareaID) {
    //         return response()->json([
    //             "persan" => "Polt Area tidak terkirim",
    //             "PoltArea" => $poltareaID
    //         ], 404);
    //     }

    //     try {
    //         // validasi reques
    //         $validatedData = $request->validate([
    //             'polt-area_id' => 'required|integer|exists:polt-area,id',
    //             'total_berat_basah' => 'required|numeric|min:0',
    //             'sample_berat_basah' => 'required|numeric|min:0',
    //             'sample_berat_kering' => 'required|numeric|min:0',
    //         ]);

    //         // Pastikan tidak ada pembagian dengan nol
    //         if ($request->sample_berat_basah == 0) {
    //             return response()->json([
    //                 'message' => 'Sample berat basah tidak boleh nol.'
    //             ], 400);
    //         }
    //         // lakuan perhitungan
    //         $TotalBeratKering = ($request->sample_berat_kering / $request->sample_berat_basah) * $request->total_berat_basah;
    //         $kandunganKarbon =  $TotalBeratKering * 0.47;
    //         $co2 = $kandunganKarbon * (44 / 12);
    //         // menyimpan data ke database, termaksud hasil pergitungan
    //         $Serasah = Serasah::create([
    //             'polt_area_id' => $poltareaID,
    //             'total_berat_basah' => $request->total_berat_basah,
    //             'sample_berat_basah' => $request->sample_berat_basah,
    //             'sample_berat_kering' => $request->sample_berat_kering,
    //             'total_berat_kering' => $TotalBeratKering,
    //             'kandungan_karbon' => $kandunganKarbon,
    //             'co2' => $co2,
    //         ]);

    //         // Response sukses
    //         return response()->json([
    //             'message' => 'Serasah berhasil dibuat',
    //             'data' => $Serasah
    //         ], 201);
    //     } catch (\Exception $e) {
    //         // Response error
    //         return response()->json([
    //             'message' => 'Gagal membuat Serasah',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function store(Request $request)
    {
        // ambil poltArea berdasarkan id
        $poltareaID = $request->input("polt-area_id"); // pastikan polt-area_id dikirim dari FE
        $polt = PoltArea::find($poltareaID);
        if (!$poltareaID) {
            return response()->json([
                "persan" => "Polt Area tidak terkirim",
                "PoltArea" => $poltareaID
            ], 404);
        }

        try {
            // validasi reques
            $validatedData = $request->validate([
                'polt-area_id' => 'required|integer|exists:polt-area,id',
                'total_berat_basah' => 'required|numeric|min:0',
                'sample_berat_basah' => 'required|numeric|min:0',
                'sample_berat_kering' => 'required|numeric|min:0',
            ]);

            // Pastikan tidak ada pembagian dengan nol
            if ($request->sample_berat_basah == 0) {
                return response()->json([
                    'message' => 'Sample berat basah tidak boleh nol.'
                ], 400);
            }
            // lakuan perhitungan
            $TotalBeratKering = ($request->sample_berat_kering / $request->sample_berat_basah) * $request->total_berat_basah;
            $kandunganKarbon =  $TotalBeratKering * 0.47;
            $co2 = $kandunganKarbon * (44 / 12);
            // menyimpan data ke database, termaksud hasil pergitungan
            $Serasah = Serasah::create([
                'polt-area_id' => $polt->id,
                'total_berat_basah' => $request->total_berat_basah,
                'sample_berat_basah' => $request->sample_berat_basah,
                'sample_berat_kering' => $request->sample_berat_kering,
                'total_berat_kering' => $TotalBeratKering,
                'kandungan_karbon' => $kandunganKarbon,
                'co2' => $co2,
            ]);

            // Response sukses
            // return response()->json([
            //     'message' => 'Serasah berhasil dibuat',
            //     'data' => $Serasah
            // ], 201);
            return redirect()->back()->with('success', 'Serasah berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Response error
            // return response()->json([
            //     'message' => 'Gagal membuat Serasah',
            //     'error' => $e->getMessage()
            // ], 500);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subplot = SubPlot::findOrFail($id);

        // Mengambil data dari setiap tabel yang berhubungan dengan subplot_id
        $tumbuhanbawah = TumbuhanBawah::where('subplot_id', $subplot->id)->first();
        $semai = Semai::where('subplot_id', $subplot->id)->first();
        $serasah = Serasah::where('subplot_id', $subplot->id)->first();
        $tanah = Tanah::where('subplot_id', $subplot->id)->first(); // Tanah sudah benar

        return view('edit.PlotA', compact('subplot', 'tumbuhanbawah', 'semai', 'serasah', 'tanah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validasi reques
        $validatedData = $request->validate([
            'subplot_id' => 'required|integer|exists:subplot,id',
            'total_berat_basah' => 'required|numeric|min:0',
            'sample_berat_basah' => 'required|numeric|min:0',
            'sample_berat_kering' => 'required|numeric|min:0',
        ]);
        // dd( $request->all());
        DB::beginTransaction();
        try {
            // Cari data Serasah berdasarkan ID
            $subplot = SubPlot::findOrFail($id);
            $serasah = Serasah::where('subplot_id', $subplot->id)->first();
            // Pastikan tidak ada pembagian dengan nol
            if (!$serasah) {
                return redirect()->back()->with('error', 'Data Serasah tidak ditemukan.');
            }
            // lakuan perhitungan
            $TotalBeratKering = ($request->sample_berat_kering / $request->sample_berat_basah) * $request->total_berat_basah;
            $kandunganKarbon =  $TotalBeratKering * 0.47;
            $co2 = $kandunganKarbon * (44 / 12);
            // update data ke database, termaksud hasil pergitungan
            $serasah->update([
                'total_berat_basah' => $request->total_berat_basah,
                'sample_berat_basah' => $request->sample_berat_basah,
                'sample_berat_kering' => $request->sample_berat_kering,
                'total_berat_kering' => $TotalBeratKering,
                'kandungan_karbon' => $kandunganKarbon,
                'co2' => $co2,
            ]);
            // dd( $serasah);
            // Response sukses
            DB::commit();
            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Serasah berhasil diperbarui.');
        } catch (\Exception $e) {
            // Response error
            DB::rollBack();

            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Gagal mengupdate Serasah: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $subplot_id)
    {
        DB::beginTransaction();
        try {
            $tanah = Serasah::where('subplot_id', $subplot_id)->first();
            // dd($subplot_id, Tanah::where('subplot_id', $subplot_id)->first());
            $tanah->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Data Serasah berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus data Serasah: ' . $e->getMessage());
        }
    }
}
