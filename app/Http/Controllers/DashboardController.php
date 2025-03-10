<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PoltArea;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $poltArea = PoltArea::where('id', $user->id)->first();
        return view('dashboard', compact('user',  'poltArea'));
    }
    public function showChart(Request $request)
    {
        $user = Auth::user();
        $dataDaerah = PoltArea::pluck('daerah')->toArray();

        return view('dashboard', compact('user','dataDaerah'));
        // $tahun = $request->input('tahun', date('Y')); // Default tahun sekarang jika tidak ada input

        //     // Ambil daftar daerah dari database
        //     $dataDaerah  = DB::table('serasah')
        //     ->join('subplot', 'serasah.subplot_id', '=', 'subplot.id')
        //     ->join('beabbs', 'subplot.beabbs_id', '=', 'beabbs.id')
        //     ->join('plot', 'beabbs.plot_id', '=', 'plot.id')
        //     ->join('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
        //     ->join('zona', 'hamparan.zona_id', '=', 'zona.id')
        //     ->join('polt_area', 'zona.polt_area_id', '=', 'polt_area.id')
        //     ->select('polt_area.daerah as nama', DB::raw('SUM(serasah.carbon_stock) as total_carbon'))
        //     ->whereYear('serasah.created_at', $tahun)
        //     ->groupBy('polt_area.daerah')
        //     ->get();

        //     // Ambil data total karbon per daerah
        //     $carbonData = DB::table('serasah')
        //         ->select('daerah', DB::raw('SUM(carbon_stock) as total_carbon'))
        //         ->whereYear('created_at', $tahun)
        //         ->groupBy('daerah')
        //         ->union(DB::table('pancang')->select('daerah', DB::raw('SUM(carbon_stock) as total_carbon'))->whereYear('created_at', $tahun)->groupBy('daerah'))
        //         ->union(DB::table('tiang')->select('daerah', DB::raw('SUM(carbon_stock) as total_carbon'))->whereYear('created_at', $tahun)->groupBy('daerah'))
        //         ->union(DB::table('pohon')->select('daerah', DB::raw('SUM(carbon_stock) as total_carbon'))->whereYear('created_at', $tahun)->groupBy('daerah'))
        //         ->get()
        //         ->groupBy('daerah')
        //         ->map(function ($items) {
        //             return $items->sum('total_carbon');
        //         });

        //     // Ambil data total serapan karbon per daerah
        //     $absorptionData = DB::table('serasah')
        //         ->select('daerah', DB::raw('SUM(carbon_absorption) as total_absorption'))
        //         ->whereYear('created_at', $tahun)
        //         ->groupBy('daerah')
        //         ->union(DB::table('pancang')->select('daerah', DB::raw('SUM(carbon_absorption) as total_absorption'))->whereYear('created_at', $tahun)->groupBy('daerah'))
        //         ->union(DB::table('tiang')->select('daerah', DB::raw('SUM(carbon_absorption) as total_absorption'))->whereYear('created_at', $tahun)->groupBy('daerah'))
        //         ->union(DB::table('pohon')->select('daerah', DB::raw('SUM(carbon_absorption) as total_absorption'))->whereYear('created_at', $tahun)->groupBy('daerah'))
        //         ->get()
        //         ->groupBy('daerah')
        //         ->map(function ($items) {
        //             return $items->sum('total_absorption');
        //         });

        //     // Format data agar sesuai dengan grafik
        //     $carbonValues = [];
        //     $absorptionValues = [];

        //     foreach ($dataDaerah as $daerah) {
        //         $carbonValues[] = $carbonData[$daerah] ?? 0;
        //         $absorptionValues[] = $absorptionData[$daerah] ?? 0;
        //     }

        //     return view('chart', [
        //         'tahun' => $tahun,
        //         'categories' => json_encode($dataDaerah),
        //         'carbonSeries' => json_encode($carbonValues),
        //         'absorptionSeries' => json_encode($absorptionValues),
        //     ]);
    }
}
