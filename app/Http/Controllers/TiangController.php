<?php

namespace App\Http\Controllers;

use App\Models\Tiang;
use App\Models\PoltArea;
use Illuminate\Http\Request;
use App\Http\Resources\PancangResouce;
use App\Models\SubPlot;
use App\Models\Zona;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TiangController extends Controller
{
    public function index()
    {
        // $Tiang = Tiang::get();
        // return PancangResouce::collection($Tiang);
        $user = Auth::user();
        $poltArea = PoltArea::where('id', $user->id);
        $zona = Zona::where('polt-area_id', $user->id);
        $PlotC = Tiang::where('zona_id');
        return view('tambah.PlotC', compact('user', 'poltArea', 'zona', 'PlotC'));
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
                'keliling' => 'required|numeric|min:0',  // Input keliling pohon (cm)
                'nama_lokal' => 'required|string',
                'nama_ilmiah' => 'required|string',
                'kerapatan_jenis_kayu' => 'required|numeric|min:0',  // Kerapatan jenis kayu (gr/cm³)
            ]);

            // Ambil input keliling dan kerapatan jenis kayu
            $keliling = $request->keliling;
            $kerapatanJenisKayu = $request->kerapatan_jenis_kayu;

            // Perhitungan diameter dari keliling (keliling / π)
            $diameter = $keliling / pi();  // pi() memberikan nilai π (3.1416)

            // Tentukan rentang diameter (2-9 atau 10-19)
            if ($diameter < 10.00 || $diameter > 19.99) {
                // return response()->json([
                //     "pesan" => "Diameter harus diantara 10 hingga 19 cm.",
                // ], 404);
                return redirect()->back()->with('Pesan', 'Diameter harus diantara 10 hingga 19 cm.');
            }


            // Perhitungan biomassa di atas tanah dengan rumus: 0.11 * ρ * D^2.62
            $biomassa = 0.11 * $kerapatanJenisKayu * pow($diameter, 2.62);

            // Perhitungan kandungan karbon (diasumsikan 47% dari biomassa)
            $kandunganKarbon = $biomassa * 0.47;
            // Perhitungan CO2 (Ton)
            $co2 = $kandunganKarbon * (44 / 12);
            // Simpan data ke database
            $Tiang = Tiang::create([
                'polt-area_id' => $polt->id,
                'keliling' => $keliling,  // Simpan keliling dari input
                'diameter' => $diameter,  // Simpan hasil perhitungan diameter
                'nama_lokal' => $request->nama_lokal,
                'nama_ilmiah' => $request->nama_ilmiah,  // Simpan rentang diameter
                'kerapatan_jenis_kayu' => $kerapatanJenisKayu,
                'bio_di_atas_tanah' => $biomassa,
                'kandungan_karbon' => $kandunganKarbon,
                'co2' => $co2,
            ]);

            // Response sukses
            // return response()->json([
            //     'message' => ' Tiang berhasil dibuat',
            //     'data' => $Tiang
            // ], 201);
            return redirect()->back()->with('success', 'Tiang berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Response error
            // return response()->json([
            //     'message' => 'Gagal membuat Tiang',
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
                'keliling' => 'required|numeric|min:0',  // Input keliling pohon (cm)
                'nama_lokal' => 'required|string',
                'nama_ilmiah' => 'required|string',
                'kerapatan_jenis_kayu' => 'required|numeric|min:0',  // Kerapatan jenis kayu (gr/cm³)
            ]);
            // Cari data Tiang berdasarkan ID
            $pancnag = Tiang::findOrFail($id);
            // Ambil input keliling dan kerapatan jenis kayu
            $keliling = $request->keliling;
            $kerapatanJenisKayu = $request->kerapatan_jenis_kayu;

            // Perhitungan diameter dari keliling (keliling / π)
            $diameter = $keliling / pi();  // pi() memberikan nilai π (3.1416)

            // Tentukan rentang diameter (2-9 atau 10-19)
            if ($diameter < 10.00 || $diameter > 19.00) {
                return response()->json([
                    "pesan" => "Diameter harus diantara 10 hingga 19 cm.",
                ], 404);
            }

            // Perhitungan biomassa di atas tanah dengan rumus: 0.11 * ρ * D^2.62
            $biomassa = 0.11 * $kerapatanJenisKayu * pow($diameter, 2.62);

            // Perhitungan kandungan karbon (diasumsikan 47% dari biomassa)
            $kandunganKarbon = $biomassa * 0.47;
            // Perhitungan CO2 (Ton)
            $co2 = $kandunganKarbon * (44 / 12);
            // update data ke database, termaksud hasil pergitungan
            $pancnag->update([
                'keliling' => $keliling,  // Simpan keliling dari input
                'diameter' => $diameter,  // Simpan hasil perhitungan diameter
                'nama_lokal' => $request->nama_lokal,
                'nama_ilmiah' => $request->nama_ilmiah,  // Simpan rentang diameter
                'kerapatan_jenis_kayu' => $kerapatanJenisKayu,
                'bio_di_atas_tanah' => $biomassa,
                'kandungan_karbon' => $kandunganKarbon,
                'co2' => $co2,
            ]);

            // Response sukses
            return response()->json([
                'message' => 'Tiang berhasil diupdate',
                'data' => $pancnag
            ], 201);
        } catch (\Exception $e) {
            // Response error
            return response()->json([
                'message' => 'Gagal mengapdate Tiang',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            // Cari data Tanah berdasarkan ID
            $tanah = Tiang::findOrFail($id);


            // Hapus data tanah
            $tanah->delete();

            DB::commit();

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Data Tiang berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Gagal menghapus data Tiang: ' . $e->getMessage());
        }
    }
}
