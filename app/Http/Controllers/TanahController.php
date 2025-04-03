<?php

namespace App\Http\Controllers;

use App\Http\Resources\TanahResource;
use App\Models\Hamparan;
use App\Models\Plot;
use App\Models\Tanah;
use App\Models\PoltArea;
use App\Models\SubPlot;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TanahController extends Controller
{
    public function index($id)
    {
        $user = Auth::user();
        $subplot = SubPlot::findOrFail($id);
        $tanah = Tanah::where('subplot_id', $id)->first();
        return view('tambah.PlotA', compact('subplot', 'tanah', 'user'));
    }
    public function store(Request $request,  $id)
    {
        // ambil poltArea berdasarkan id
        // dd( $request->all());
        $validatedData = $request->validate([
            'subplot_id' => 'required|integer|exists:subplot,id',
            'kedalaman_sample' => 'required|numeric|min:0',
            'berat_jenis_tanah' => 'required|numeric|min:0',
            'C_organic_tanah' => 'required|numeric|min:0',
        ]);
        DB::beginTransaction();
        try {
            $subplot = SubPlot::findOrFail($id);

            // Cari plot yang terkait dengan subplot
            $plot = Plot::findOrFail($subplot->plot_id);

            // Cari hamparan berdasarkan plot
            $hamparan = Hamparan::findOrFail($plot->hamparan_id);

            // Cari zona berdasarkan hamparan
            $zona = Zona::findOrFail($hamparan->zona_id);

            // Cari poltArea berdasarkan zona
            $poltArea = PoltArea::findOrFail($zona->polt_area_id);
            // if (!$poltArea) {
            //     abort(404, 'Polt Area tidak ditemukan.');
            // }
            // $ringkasan = Zona::where('polt_area_id', $poltArea->id)
            $lokasi = Zona::where('polt_area_id', $poltArea->id)
                ->leftJoin('polt_area', 'zona.polt_area_id', '=', 'polt_area.id')
                ->leftJoin('hamparan', 'hamparan.zona_id', '=', 'zona.id') // Hamparan ke Zona
                ->leftJoin('plot', 'plot.hamparan_id', '=', 'hamparan.id') // Plot ke Hamparan
                ->leftJoin('subplot', 'subplot.plot_id', '=', 'plot.id') // Subplot ke Plot
                ->select(
                    'zona.id as zona_id',
                    'zona.zona as zona_nama',
                    'zona.polt_area_id',
                    'polt_area.luas_lokasi',
                )
                ->groupBy('zona.id', 'zona.zona', 'zona.polt_area_id', 'polt_area.luas_lokasi')
                ->first();
            // dd($poltArea, $lokasi->luas_lokasi);
            // Ambil input
            $kedalamanSample = $request->kedalaman_sample;
            $beratJenisTanah = $request->berat_jenis_tanah;
            $cOrganikTanah = $request->C_organic_tanah;

            // Perhitungan Carbon (gr/cm²)
            $carbonGrCm2 = $beratJenisTanah * $kedalamanSample * ($cOrganikTanah / 100);

            // Perhitungan Carbon (Ton/ha)
            $carbonTonHa = $carbonGrCm2 * 100;

            // Perhitungan Carbon (Ton)
            $carbonTon = $carbonTonHa *  $lokasi->luas_lokasi;


            // Perhitungan CO2 (Ton)
            $co2Ton = $carbonTon * 3.67;            // menyimpan data ke database, termaksud hasil pergitungan
            $Tanah = Tanah::create([
                'subplot_id' => $subplot->id,
                'kedalaman_sample' => $request->kedalaman_sample,
                'berat_jenis_tanah' => $request->berat_jenis_tanah,
                'C_organic_tanah' => $request->C_organic_tanah,
                'carbongr' => $carbonGrCm2,
                'carbonton' => $carbonTonHa,
                'carbonkg' => $carbonTon,
                'co2kg' => $co2Ton,
            ]);
            // dd($Tanah);
            // Response sukses
            // return response()->json([
            //     'message' => 'Tanah berhasil dibuat',
            //     'data' => $Tanah
            // ], 201);
            DB::commit();
            return redirect()->back()->with('success', 'Tanah berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Response error
            // return response()->json([
            //     'message' => 'Gagal membuat Tanah',
            //     'error' => $e->getMessage()
            // ], 500);
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function edit(string $id)
    {
        $subplot = SubPlot::findOrFail($id);
        $tanah = Tanah::where('subplot_id', $subplot->id)->firstOrFail();
        return view('edit.PlotA', compact('subplot', 'tanah'));
    }
    public function update(Request $request, string $id)
    {
        // validasi reques
        $validatedData = $request->validate([
            'subplot_id' => 'required|integer|exists:subplot,id',
            'kedalaman_sample' => 'required|numeric|min:0',
            'berat_jenis_tanah' => 'required|numeric|min:0',
            'C_organic_tanah' => 'required|numeric|min:0',
        ]);
        DB::beginTransaction();
        try {
            // Cari data Tanah berdasarkan ID
            $subplot = SubPlot::findOrFail($id);

            // Cari plot yang terkait dengan subplot
            $plot = Plot::findOrFail($subplot->plot_id);

            // Cari hamparan berdasarkan plot
            $hamparan = Hamparan::findOrFail($plot->hamparan_id);

            // Cari zona berdasarkan hamparan
            $zona = Zona::findOrFail($hamparan->zona_id);

            // Cari poltArea berdasarkan zona
            $poltArea = PoltArea::findOrFail($zona->polt_area_id);
            // if (!$poltArea) {
            //     abort(404, 'Polt Area tidak ditemukan.');
            // }
            // $ringkasan = Zona::where('polt_area_id', $poltArea->id)
            $lokasi = Zona::where('polt_area_id', $poltArea->id)
                ->leftJoin('polt_area', 'zona.polt_area_id', '=', 'polt_area.id')
                ->leftJoin('hamparan', 'hamparan.zona_id', '=', 'zona.id') // Hamparan ke Zona
                ->leftJoin('plot', 'plot.hamparan_id', '=', 'hamparan.id') // Plot ke Hamparan
                ->leftJoin('subplot', 'subplot.plot_id', '=', 'plot.id') // Subplot ke Plot
                ->select(
                    'zona.id as zona_id',
                    'zona.zona as zona_nama',
                    'zona.polt_area_id',
                    'polt_area.luas_lokasi',
                )
                ->groupBy('zona.id', 'zona.zona', 'zona.polt_area_id', 'polt_area.luas_lokasi')
                ->first();
            // $subplot = SubPlot::findOrFail($id);
            $tanah = Tanah::where('subplot_id', $subplot->id)->firstOrFail();

            $kedalamanSample = $request->kedalaman_sample;
            $beratJenisTanah = $request->berat_jenis_tanah;
            $cOrganikTanah = $request->C_organic_tanah;

            // Perhitungan Carbon (gr/cm²)
            $carbonGrCm2 = $beratJenisTanah * $kedalamanSample * ($cOrganikTanah / 100);

            // Perhitungan Carbon (Ton/ha)
            $carbonTonHa = $carbonGrCm2 * 100;

            // Perhitungan Carbon (Ton)
            $carbonTon = $carbonTonHa *  $lokasi->luas_lokasi;

            // Perhitungan CO2 (Ton)
            $co2Ton = $carbonTon * 3.67;            // update data ke database, termaksud hasil pergitungan
            $tanah->update([
                'kedalaman_sample' => $request->kedalaman_sample,
                'berat_jenis_tanah' => $request->berat_jenis_tanah,
                'C_organic_tanah' => $request->C_organic_tanah,
                'carbongr' => $carbonGrCm2,
                'carbonton' => $carbonTonHa,
                'carbonkg' => $carbonTon,
                'co2kg' => $co2Ton,
            ]);
            // dd($tanah, $lokasi->luas_lokasi);
            // Response sukses
            // return response()->json([
            //     'message' => 'Tanah berhasil diupdate',
            //     'data' => $serasah
            // ], 201);
            DB::commit();
            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Tanah berhasil diperbarui.');
        } catch (\Exception $e) {
            // Response error
            // return response()->json([
            //     'message' => 'Gagal mengapdate Tanah',
            //     'error' => $e->getMessage()
            // ], 500);
            DB::rollBack();

            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Gagal mengupdate Tanah: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        dd($id); // Cek ID yang diterima sebelum hapus data

    DB::beginTransaction();
    try {
        $tanah = Tanah::findOrFail($id);
        $tanah->delete();
        DB::commit();
        return redirect()->back()->with('success', 'Data tanah berhasil dihapus.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Gagal menghapus data tanah: ' . $e->getMessage());
    }
    }
}
