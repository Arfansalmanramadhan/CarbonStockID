<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PoltArea;

class SampahController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $lokasi = DB::table('polt_area')->select('id', 'daerah')->get();
        return view("Sampah", compact('user', 'lokasi'));
    }
    public function hitung(Request $request)
    {
        $user = Auth::user(); // <- Tambahkan ini
        $lokasiId = $request->lokasi_id;
        $lokasi = DB::table('polt_area')->select('id', 'daerah')->get();

        $pancang = DB::table('pancang')
            ->join('subplot', 'pancang.subplot_id', '=', 'subplot.id')
            ->join('plot', 'subplot.plot_id', '=', 'plot.id')
            ->join('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
            ->join('zona', 'hamparan.zona_id', '=', 'zona.id')
            ->join('polt_area', 'zona.polt_area_id', '=', 'polt_area.id')
            ->where('polt_area.id', $lokasiId)
            ->select('pancang.nama_ilmiah', 'pancang.no_pohon')
            ->get();

        $tiang = DB::table('tiang')
            ->join('subplot', 'tiang.subplot_id', '=', 'subplot.id')
            ->join('plot', 'subplot.plot_id', '=', 'plot.id')
            ->join('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
            ->join('zona', 'hamparan.zona_id', '=', 'zona.id')
            ->join('polt_area', 'zona.polt_area_id', '=', 'polt_area.id')
            ->where('polt_area.id', $lokasiId)
            ->select('tiang.nama_ilmiah', 'tiang.no_pohon')
            ->get();

        $pohon = DB::table('pohon')
            ->join('subplot', 'pohon.subplot_id', '=', 'subplot.id')
            ->join('plot', 'subplot.plot_id', '=', 'plot.id')
            ->join('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
            ->join('zona', 'hamparan.zona_id', '=', 'zona.id')
            ->join('polt_area', 'zona.polt_area_id', '=', 'polt_area.id')
            ->where('polt_area.id', $lokasiId)
            ->select('pohon.nama_ilmiah', 'pohon.no_pohon')
            ->get();

        // dd($data);
        $dataGabungan = collect()->merge($pancang)->merge($tiang)->merge($pohon);

        $spesies_counter = [];

        foreach ($dataGabungan as $item) {
            if ($item->nama_ilmiah && $item->no_pohon) {
                $spesies_counter[$item->nama_ilmiah] = ($spesies_counter[$item->nama_ilmiah] ?? 0) + 1;
            }
        }
        // dd($spesies_counter[$item->nama_ilmiah] ,$spesies_counter[$item->nama_ilmiah] ?? 0);
        $total = array_sum($spesies_counter);
        $detail = [];
        $h = 0;

        foreach ($spesies_counter as $spesies => $jumlah) {
            $pi = $jumlah / $total;
            $ln_pi = log($pi);
            $neg_pi_ln_pi = -$pi * $ln_pi;
            $h += $neg_pi_ln_pi;

            $detail[] = [
                'spesies' => $spesies,
                'jumlah_individu' => $jumlah,
                'pi' => round($pi, 4),
                'ln_pi' => round($ln_pi, 6),
                'neg_pi_ln_pi' => round($neg_pi_ln_pi, 6),
            ];
            // dd( $dataGabungan , $pancang, $tiang, $pohon,$detail,  $spesies_counter,  $jumlah);
        }

        $lokasi_nama = DB::table('polt_area')->where('id', $lokasiId)->value('daerah');
        return view('Sampah', compact('user', 'lokasi', 'detail', 'total', 'h', 'lokasiId', 'lokasi_nama'));
    }
}
