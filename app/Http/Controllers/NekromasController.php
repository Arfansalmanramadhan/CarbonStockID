<?php

namespace App\Http\Controllers;

use App\Models\PoltArea;
use App\Models\Necromass;
use Illuminate\Http\Request;
use App\Http\Resources\NekromassResource;
use App\Models\SubPlot;
use Illuminate\Support\Facades\DB;

class NekromasController extends Controller
{
    public function index()
    {
        $Nekromas = Necromass::get();
        return NekromassResource::collection($Nekromas);
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
            // Validasi input
            $validatedData = $request->validate([
                'polt-area_id' => 'required|integer|exists:polt-area,id',
                'diameter_pangkal' => 'required|numeric|min:0',
                'diameter_ujung' => 'required|numeric|min:0',
                'panjang' => 'required|numeric|min:0',
                'berat_jenis_kayu' => 'required|numeric|min:0',  // Kerapatan jenis kayu (gr/cm³)
            ]);

            // Ambil nilai dari request
            $diameterUjung = $request->diameter_ujung;
            $diameterPangkal = $request->diameter_pangkal;
            $panjang = $request->panjang;
            $beratJenisKayu = $request->berat_jenis_kayu;

            // Perhitungan diameter rata-rata
            $diameterRataRata = ($diameterUjung + $diameterPangkal) / 2;

            // Perhitungan volume (m³)
            $volume = (pi() / 4) * pow($diameterRataRata, 2) * $panjang;

            // Perhitungan biomassa (kg)
            $biomassa = $volume * $beratJenisKayu; // Berat jenis kayu mempengaruhi biomassa

            // Perhitungan kandungan karbon (kg)
            $kandunganKarbon = $biomassa * 0.47;

            // Perhitungan serapan CO2 (kg)
            $co2 = $kandunganKarbon * (44 / 12);
            // Simpan data ke database
            $Necro = Necromass::create([
                'polt-area_id' => $polt->id,
                'diameter_pangkal' => $diameterPangkal,  // Simpan keliling dari input
                'diameter_ujung' => $diameterUjung,  // Simpan hasil perhitungan diameter
                'panjang' =>  $panjang,
                'volume' => $volume,  // Simpan rentang diameter
                'berat_jenis_kayu' => $beratJenisKayu,
                'biomasa' => $biomassa,
                'carbon' => $kandunganKarbon,
                'co2' => $co2,
            ]);

            // Response sukses
            // return response()->json([
            //     'message' => ' Necromass berhasil dibuat',
            //     'data' => $Necro
            // ], 201);
            return redirect()->back()->with('success', 'Pohon berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Response error
            // return response()->json([
            //     'message' => 'Gagal membuat Necromass',
            //     'error' => $e->getMessage()
            // ], 500);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function update(Request $request, string $id)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'diameter_pangkal' => 'required|numeric|min:0',
                'diameter_ujung' => 'required|numeric|min:0',
                'panjang' => 'required|numeric|min:0',
                'berat_jenis_kayu' => 'required|numeric|min:0'
            ]);
            // Cari data Pohon berdasarkan ID
            $Necromass = Necromass::findOrFail($id);

            // Ambil nilai dari request
            $diameterUjung = $request->diameter_ujung;
            $diameterPangkal = $request->diameter_pangkal;
            $panjang = $request->panjang;
            $beratJenisKayu = $request->berat_jenis_kayu;

            // Perhitungan diameter rata-rata
            $diameterRataRata = ($diameterUjung + $diameterPangkal) / 2;

            // Perhitungan volume (m³)
            $volume = (pi() / 4) * pow($diameterRataRata, 2) * $panjang;

            // Perhitungan biomassa (kg)
            $biomassa = $volume * $beratJenisKayu; // Berat jenis kayu mempengaruhi biomassa

            // Perhitungan kandungan karbon (kg)
            $kandunganKarbon = $biomassa * 0.47;

            // Perhitungan serapan CO2 (kg)
            $co2 = $kandunganKarbon * (44 / 12);
            // update data ke database, termaksud hasil pergitungan
            $Necromass->update([
                'diameter_pangkal' => $diameterPangkal,  // Simpan keliling dari input
                'diameter_ujung' => $diameterUjung,  // Simpan hasil perhitungan diameter
                'panjang' =>  $panjang,
                'volume' => $volume,  // Simpan rentang diameter
                'berat_jenis_kayu' => $beratJenisKayu,
                'biomasa' => $biomassa,
                'carbon' => $kandunganKarbon,
                'co2' => $co2,
            ]);

            // Response sukses
            return response()->json([
                'message' => 'Necromass berhasil diupdate',
                'data' => $Necromass
            ], 201);
        } catch (\Exception $e) {
            // Response error
            return response()->json([
                'message' => 'Gagal mengapdate Necromas',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function destroy(string $subplot_id)
    {
        DB::beginTransaction();
        try {
            // Cari data Tanah berdasarkan ID
            $necromas = Necromass::where('subplot_id', $subplot_id)->first();



            // Hapus data necromas
            $necromas->delete();

            DB::commit();

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Data necromas berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Gagal menghapus data necromas: ' . $e->getMessage());
        }
    }
}
