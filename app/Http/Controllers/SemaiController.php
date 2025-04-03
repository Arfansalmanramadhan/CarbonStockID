<?php

namespace App\Http\Controllers;

use App\Models\Semai;
use App\Models\PoltArea;
use Illuminate\Http\Request;
use App\Http\Resources\SerasahResource;
use App\Models\SubPlot;
use Illuminate\Support\Facades\DB;

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
            DB::commit();
            return redirect()->back()->with('success', 'Semai berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Response error
            // return response()->json([
            //     'message' => 'Gagal membuat Semai',
            //     'error' => $e->getMessage()
            // ], 500);
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function edit(string $id)
    {
        $subplot = SubPlot::findOrFail($id);
        $semai = Semai::where('subplot_id', $subplot->id)->firstOrFail();

        return view('edit.PlotA', compact('subplot', 'semai'));
    }
    public function update(Request $request, string $id)
    {
        // validasi reques
        $validatedData = $request->validate([
            'subplot_id' => 'required|integer|exists:subplot,id',
            'total_berat_basah' => 'required|numeric|min:0',
            'sample_berat_basah' => 'required|numeric|min:0',
            'sample_berat_kering' => 'required|numeric|min:0',
        ]);
        DB::beginTransaction();
        try {
            // Cari data Semai berdasarkan ID
            $subplot = SubPlot::findOrFail($id);
            $semai = Semai::where('subplot_id', $subplot->id)->first();
            if (!$semai) {
                return redirect()->back()->with('error', 'Data Serasah tidak ditemukan.');
            }
            // lakuan perhitungan
            $TotalBeratKering = ($request->sample_berat_kering / $request->sample_berat_basah) * $request->total_berat_basah;
            $kandunganKarbon =  $TotalBeratKering * 0.47;
            $co2 = $kandunganKarbon * (44 / 12);
            // update data ke database, termaksud hasil pergitungan
            $semai->update([
                'total_berat_basah' => $request->total_berat_basah,
                'sample_berat_basah' => $request->sample_berat_basah,
                'sample_berat_kering' => $request->sample_berat_kering,
                'total_berat_kering' => $TotalBeratKering,
                'kandungan_karbon' => $kandunganKarbon,
                'co2' => $co2,
            ]);

            // Response sukses
            // return response()->json([
            //     'message' => 'Semai berhasil diupdate',
            //     'data' => $semai
            // ], 201);
            DB::commit();
            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Semai berhasil diperbarui.');
        } catch (\Exception $e) {
            // Response error
            // return response()->json([
            //     'message' => 'Gagal mengapdate Semai',
            //     'error' => $e->getMessage()
            // ], 500);
            DB::rollBack();

            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Gagal mengupdate Semai: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            // Cari data Tanah berdasarkan ID
            $semai = Semai::findOrFail($id);

            // Pastikan subplot yang terkait ada
            $subplot = SubPlot::findOrFail($semai->subplot_id);

            // Hapus data tanah
            $semai->delete();

            DB::commit();

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Data tanah berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Gagal menghapus data tanah: ' . $e->getMessage());
        }
    }
}
