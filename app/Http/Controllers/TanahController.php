<?php

namespace App\Http\Controllers;

use App\Http\Resources\TanahResource;
use App\Models\Tanah;
use App\Models\PoltArea;
use Illuminate\Http\Request;

class TanahController extends Controller
{
    public function index()
    {
        $tanah = Tanah::get();
        return TanahResource::collection($tanah);
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
                'kedalaman_sample' => 'required|numeric|min:0',
                'berat_jenis_tanah' => 'required|numeric|min:0',
                'C_organic_tanah' => 'required|numeric|min:0',
            ]);

            // Ambil input
            $kedalamanSample = $request->kedalaman_sample;
            $beratJenisTanah = $request->berat_jenis_tanah;
            $cOrganikTanah = $request->C_organic_tanah;

            // Perhitungan Carbon (gr/cm²)
            $carbonGrCm2 = $beratJenisTanah * $kedalamanSample * ($cOrganikTanah / 100);

            // Perhitungan Carbon (Ton/ha)
            $carbonTonHa = $carbonGrCm2 * 100;

            // Perhitungan Carbon (Ton)
            $carbonTon = $carbonTonHa * 11.5;

            // Perhitungan CO2 (Ton)
            $co2Ton = $carbonTon * (44 / 12);
            // menyimpan data ke database, termaksud hasil pergitungan 
            $Tanah = Tanah::create([
                'polt-area_id' => $polt->id,
                'kedalaman_sample' => $request->kedalaman_sample,
                'berat_jenis_tanah' => $request->berat_jenis_tanah,
                'C_organic_tanah' => $request->C_organic_tanah,
                'carbongr' => $carbonGrCm2,
                'carbonton' => $carbonTonHa,
                'carbonkg' => $carbonTon,
                'co2kg' => $co2Ton,
            ]);

            // Response sukses
            return response()->json([
                'message' => 'Tanah berhasil dibuat',
                'data' => $Tanah
            ], 201);
        } catch (\Exception $e) {
            // Response error
            return response()->json([
                'message' => 'Gagal membuat Tanah',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            // validasi reques 
            $validatedData = $request->validate([
                'kedalaman_sample' => 'required|numeric|min:0',
                'berat_jenis_tanah' => 'required|numeric|min:0',
                'C_organic_tanah' => 'required|numeric|min:0',
            ]);
            // Cari data Tanah berdasarkan ID
            $serasah = Tanah::findOrFail($id);
            $kedalamanSample = $request->kedalaman_sample;
            $beratJenisTanah = $request->berat_jenis_tanah;
            $cOrganikTanah = $request->C_organic_tanah;

            // Perhitungan Carbon (gr/cm²)
            $carbonGrCm2 = $beratJenisTanah * $kedalamanSample * ($cOrganikTanah / 100);

            // Perhitungan Carbon (Ton/ha)
            $carbonTonHa = $carbonGrCm2 * 100;

            // Perhitungan Carbon (Ton)
            $carbonTon = $carbonTonHa * 11.5;

            // Perhitungan CO2 (Ton)
            $co2Ton = $carbonTon * (44 / 12);
            // update data ke database, termaksud hasil pergitungan 
            $serasah->update([
                'kedalaman_sample' => $request->kedalaman_sample,
                'berat_jenis_tanah' => $request->berat_jenis_tanah,
                'C_organic_tanah' => $request->C_organic_tanah,
                'carbongr' => $carbonGrCm2,
                'carbonton' => $carbonTonHa,
                'carbonkg' => $carbonTon,
                'co2kg' => $co2Ton,
            ]);

            // Response sukses
            return response()->json([
                'message' => 'Tanah berhasil diupdate',
                'data' => $serasah
            ], 201);
        } catch (\Exception $e) {
            // Response error
            return response()->json([
                'message' => 'Gagal mengapdate Tanah',
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
            // Cari data Tanah berdasarkan ID
            $serasah = Tanah::findOrFail($id);

            // Hapus data
            $serasah->delete();

            // Response sukses
            return response()->json([
                'message' => 'Tanah berhasil dihapus'
            ], 200);
        } catch (\Exception $e) {
            // Response error
            return response()->json([
                'message' => 'Gagal menghapus Tanah',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
