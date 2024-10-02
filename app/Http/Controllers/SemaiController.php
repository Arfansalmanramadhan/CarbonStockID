<?php

namespace App\Http\Controllers;

use App\Models\Semai;
use App\Models\PoltArea;
use Illuminate\Http\Request;
use App\Http\Resources\SerasahResource;

class SemaiController extends Controller
{
    public function index()
    {
        $serasah = Semai::get();
        return SerasahResource::collection($serasah);
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
            $Semai = Semai::create([
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
            //     'message' => 'Semai berhasil dibuat',
            //     'data' => $Semai
            // ], 201);
            return redirect()->back()->with('success', 'Serasah berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Response error
            return response()->json([
                'message' => 'Gagal membuat Semai',
                'error' => $e->getMessage()
            ], 500);
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
            // Cari data Semai berdasarkan ID
            $serasah = Semai::findOrFail($id);
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
                'message' => 'Semai berhasil diupdate',
                'data' => $serasah
            ], 201);
        } catch (\Exception $e) {
            // Response error
            return response()->json([
                'message' => 'Gagal mengapdate Semai',
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
            // Cari data Semai berdasarkan ID
            $serasah = Semai::findOrFail($id);

            // Hapus data
            $serasah->delete();

            // Response sukses
            return response()->json([
                'message' => 'Semai berhasil dihapus'
            ], 200);
        } catch (\Exception $e) {
            // Response error
            return response()->json([
                'message' => 'Gagal menghapus Semai',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
