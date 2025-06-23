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

        $pohon = DB::table('jumlah_pohon')
            ->join('polt_area', 'jumlah_pohon.polt_area_id', '=', 'polt_area.id')
            ->where('polt_area.id', $lokasiId)
            ->select('jumlah_pohon.nama_tanaman', 'jumlah_pohon.jumlah_tanaman')
            // ->where('plot.status', 'aktif')
            ->get();

        // $tiang = DB::table('tiang')
        //     ->join('subplot', 'tiang.subplot_id', '=', 'subplot.id')
        //     ->join('plot', 'subplot.plot_id', '=', 'plot.id')
        //     ->join('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
        //     ->join('zona', 'hamparan.zona_id', '=', 'zona.id')
        //     ->join('polt_area', 'zona.polt_area_id', '=', 'polt_area.id')
        //     ->where('polt_area.id', $lokasiId)
        //     ->select('tiang.nama_ilmiah', 'tiang.no_pohon')
        //     ->where('plot.status', 'aktif')
        //     ->get();

        // $pohon = DB::table('pohon')
        //     ->join('subplot', 'pohon.subplot_id', '=', 'subplot.id')
        //     ->join('plot', 'subplot.plot_id', '=', 'plot.id')
        //     ->join('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
        //     ->join('zona', 'hamparan.zona_id', '=', 'zona.id')
        //     ->join('polt_area', 'zona.polt_area_id', '=', 'polt_area.id')
        //     ->where('polt_area.id', $lokasiId)
        //     ->select('pohon.nama_ilmiah', 'pohon.no_pohon')
        //     ->where('plot.status', 'aktif')
        //     ->get();

        // dd($data);
        // $dataGabungan = collect()->merge($pohon);

        $spesies_counter = [];

        foreach ($pohon as $item) {
            if ($item->nama_tanaman && $item->jumlah_tanaman) {
                $spesies_counter[$item->nama_tanaman] = ($spesies_counter[$item->nama_tanaman] ?? 0) + $item->jumlah_tanaman;
            }
        }
        // dd($spesies_counter[$item->nama_tanaman] ,$spesies_counter[$item->nama_tanaman] ?? 0);
        $total = array_sum($spesies_counter);
        // dd($total);
        $detail = [];
        $h = 0;

        foreach ($spesies_counter as $spesies => $jumlah) {
            $pi = $jumlah / $total;
            $ln_pi = log($pi);
            $neg_pi_ln_pi = -$pi * $ln_pi;
            $h += $neg_pi_ln_pi;
            // dd($pi,  $ln_pi , $neg_pi_ln_pi, $h, $jumlah, $total);
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
    public function peta()
    {
        $user = Auth::user();
        $lokasi = DB::table('polt_area')->select('id', 'daerah')->get();
        return view("Peta", compact('user', 'lokasi'));
    }
}
