<?php

namespace App\Http\Controllers;

use App\Models\PoltArea;
use Illuminate\Http\Request;
use App\Models\TumbuhanBawah;
use App\Http\Resources\SerasahResource;

class TunmbuhanBawahController extends Controller
{
    public function index()
    {
        $tumbuhanbawah = TumbuhanBawah::get();
        return SerasahResource::collection($tumbuhanbawah);
    }
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
            $TumbuhanBawah = TumbuhanBawah::create([
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
            //     'message' => 'TumbuhanBawah berhasil dibuat',
            //     'data' => $TumbuhanBawah
            // ], 201);
            return redirect()->back()->with('success', 'Tumbuhan bawah berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Response error
            // return response()->json([
            //     'message' => 'Gagal membuat TumbuhanBawah',
            //     'error' => $e->getMessage()
            // ], 500);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            // validasi reques 
            $validatedData = $request->validate([
                'total_berat_basah' => 'required|numeric|min:0',
                'sample_berat_basah' => 'required|numeric|min:0',
                'sample_berat_kering' => 'required|numeric|min:0',
            ]);
            // Cari data TumbuhanBawah berdasarkan ID
            $serasah = TumbuhanBawah::findOrFail($id);
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
            // update data ke database, termaksud hasil pergitungan 
            $serasah->update([
                'total_berat_basah' => $request->total_berat_basah,
                'sample_berat_basah' => $request->sample_berat_basah,
                'sample_berat_kering' => $request->sample_berat_kering,
                'total_berat_kering' => $TotalBeratKering,
                'kandungan_karbon' => $kandunganKarbon,
                'co2' => $co2,
            ]);

            // Response sukses
            return response()->json([
                'message' => 'TumbuhanBawah berhasil diupdate',
                'data' => $serasah
            ], 201);
        } catch (\Exception $e) {
            // Response error
            return response()->json([
                'message' => 'Gagal mengapdate TumbuhanBawah',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Cari data TumbuhanBawah berdasarkan ID
            $serasah = TumbuhanBawah::findOrFail($id);

            // Hapus data
            $serasah->delete();

            // Response sukses
            return response()->json([
                'message' => 'TumbuhanBawah berhasil dihapus'
            ], 200);
        } catch (\Exception $e) {
            // Response error
            return response()->json([
                'message' => 'Gagal menghapus TumbuhanBawah',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
