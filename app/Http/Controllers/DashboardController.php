<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PoltArea;
use App\Models\zona;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $poltArea = PoltArea::where('id', $user->id)->first();
        return view('dashboard', compact('user',  'poltArea',));
    }
    public function showChart(Request $request)
    {
        $user = Auth::user();
        $tahun =  $request->input('tahun', date('Y'));
        $dataDaerah = PoltArea::pluck('daerah')->toArray();
        // $poltArea = PoltArea::where('id', $user->id)->first();
        $tahun = $request->input('tahun', date('Y'));
        $ringkasann = PoltArea::leftJoin('zona', 'zona.polt_area_id', '=', 'polt_area.id')
            ->leftJoin('hamparan', 'hamparan.zona_id', '=', 'zona.id')
            ->leftJoin('plot', 'plot.hamparan_id', '=', 'hamparan.id')
            ->leftJoin('subplot', 'subplot.plot_id', '=', 'plot.id')
            // Semua entitas yang berhubungan dengan subplot
            ->leftJoin('pancang', 'pancang.subplot_id', '=', 'subplot.id')
            ->leftJoin('tiang', 'tiang.subplot_id', '=', 'subplot.id')
            ->leftJoin('pohon', 'pohon.subplot_id', '=', 'subplot.id')
            ->leftJoin('serasah', 'serasah.subplot_id', '=', 'subplot.id')
            ->leftJoin('semai', 'semai.subplot_id', '=', 'subplot.id')
            ->leftJoin('necromass', 'necromass.subplot_id', '=', 'subplot.id')
            ->leftJoin('tanah', 'tanah.subplot_id', '=', 'subplot.id')
            ->leftJoin('tumbuhan_bawah', 'tumbuhan_bawah.subplot_id', '=', 'subplot.id')
            ->leftJoin('mangrove', 'mangrove.subplot_id', '=', 'subplot.id')
            ->whereYear('polt_area.created_at', $tahun)
            ->select(
                'polt_area.id as polt_area_id',
                'polt_area.daerah as daerah',
                'polt_area.latitude  as latitude',
                'polt_area.longitude  as longitude',
                DB::raw('AVG(pancang.bio_di_atas_tanah) as pancang_avg_bio_di_atas_tanah'),
                DB::raw('AVG(pancang.kandungan_karbon) as pancang_avg_kandungan_karbon'),
                DB::raw('AVG(pancang.co2) as pancang_avg_co2'),
                DB::raw('COUNT(pancang.no_pohon) as total_pohon_pancang'),
                // Tiang
                DB::raw('AVG(tiang.bio_di_atas_tanah) as tiang_avg_bio_di_atas_tanah'),
                DB::raw('AVG(tiang.kandungan_karbon) as tiang_avg_kandungan_karbon'),
                DB::raw('AVG(tiang.co2) as tiang_avg_co2'),
                DB::raw('COUNT(tiang.no_pohon) as total_tiang'),
                // Pohon
                DB::raw('AVG(pohon.bio_di_atas_tanah) as pohon_avg_bio_di_atas_tanah'),
                DB::raw('AVG(pohon.co2) as pohon_avg_co2'),
                DB::raw('AVG(pohon.kandungan_karbon) as pohon_avg_kandungan_karbon'),
                DB::raw('COUNT(pohon.no_pohon) as total_pohon'),
                // mangrove
                DB::raw('SUM(mangrove.biomasa) as mangrove_avg_biomasa'),
                DB::raw('SUM(mangrove.karbondioksida) as mangrove_avg_karbondioksida'),
                DB::raw('SUM(mangrove.kandungan_karbon) as mangrove_avg_kandungan_karbon'),
                DB::raw('COUNT(mangrove.no_pohon) as total_mangrove'),
                // Tanah
                DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN tanah.carbonkg ELSE 0 END) as total_carbon_tanah"),
                DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN tanah.co2kg ELSE 0 END) as total_co2_tanah"),
            )
            // ->where('slug',$slug)
            ->groupBy('polt_area.id', 'polt_area.luas_lokasi', 'polt_area.latitude', 'polt_area.longitude')
            ->get()
            ->map(fn($item) => (object) $item);
        // Lakukan perhitungan tambahan untuk masing-masing zona
        // dd( $tahun);
        $ringkasann = $ringkasann->map(function ($zona) use ($tahun) {
            $faktor =   $zona->luas_lokasi ?? 11.5;
            // $faktor =  max((float) $zona->luas_lokasi, 11.5);
            // Perhitungan Pancang
            // dd( $zona);
            // $tahun = $zona->input('tahun', date('Y'));
            $zonaid = $zona->polt_area_id;
            // dd($zona->zona_nama);
            $tanahh = DB::table('tanah')
                ->leftJoin('subplot', 'tanah.subplot_id', '=', 'subplot.id')
                ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
                ->leftJoin('zona', 'hamparan.zona_id', '=', 'zona.id')
                // ->whereYear('tanah.created_at', $tahun)
                ->where('zona.polt_area_id', $zonaid)
                // ->where('plot.status', 'aktif')
                // ->select(
                //     DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN COALESCE(tanah.carbonkg, 0) ELSE 0 END) as total_carbon_tanah"),
                //     DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN COALESCE(tanah.co2kg, 0) ELSE 0 END) as total_co2_tanah")
                // )
                ->selectRaw("
                COALESCE(SUM(CASE WHEN plot.status = 'aktif' THEN tanah.carbonkg ELSE 0 END), 0) as total_carbon_tanah,
                COALESCE(SUM(CASE WHEN plot.status = 'aktif' THEN tanah.co2kg ELSE 0 END), 0) as total_co2_tanah
                ")
                ->first();
            $pancang = DB::table('pancang')
                ->leftJoin('subplot', 'pancang.subplot_id', '=', 'subplot.id')
                ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
                ->leftJoin('zona', 'hamparan.zona_id', '=', 'zona.id')
                // ->whereYear('pancang.created_at', $tahun)
                ->where('zona.polt_area_id', $zonaid)
                ->where('plot.status', 'aktif')
                ->groupBy('plot.id')
                ->select(
                    'plot.id',
                    DB::raw('AVG(pancang.bio_di_atas_tanah) as pancang_avg_bio_di_atas_tanah'),
                    DB::raw('AVG(pancang.kandungan_karbon) as pancang_avg_kandungan_karbon'),
                    DB::raw('AVG(pancang.co2) as pancang_avg_co2'),
                    DB::raw('COUNT(pancang.no_pohon) as total_pohon_pancang'),
                )
                ->get();
            $totalPlotPancang = count($pancang);
            // dd( $totalPlotPancang);
            $totalPancangCo2Keseluruhan = 0;
            $totalPancangKarbonKeseluruhan = 0;
            $totalPancangBiomassaKeseluruhan = 0;
            foreach ($pancang as $pancangg) {

                $constantPancang = 25;
                $TotalPancangco2 = ($pancangg->pancang_avg_co2 * ($pancangg->total_pohon_pancang / $constantPancang) * 10000) / 1000;
                $TotalPancangkarbon = ($pancangg->pancang_avg_kandungan_karbon * ($pancangg->total_pohon_pancang / $constantPancang) * 10000) / 1000;
                $TotalPancangbiomassa = ($pancangg->pancang_avg_bio_di_atas_tanah * ($pancangg->total_pohon_pancang / $constantPancang) * 10000) / 1000;

                $totalPancangCo2Keseluruhan += $TotalPancangco2;
                $totalPancangKarbonKeseluruhan += $TotalPancangkarbon;
                $totalPancangBiomassaKeseluruhan += $TotalPancangbiomassa;
            }
            $rataPancangCo22 = $totalPlotPancang ? $totalPancangCo2Keseluruhan / $totalPlotPancang : 0;
            $rataPancangKarbonn = $totalPlotPancang ? $totalPancangKarbonKeseluruhan / $totalPlotPancang : 0;
            $rataPancangBiomassas = $totalPlotPancang ? $totalPancangBiomassaKeseluruhan / $totalPlotPancang : 0;
            // dd($rataPancangCo22);
            $tiang = DB::table('tiang')
                ->leftJoin('subplot', 'tiang.subplot_id', '=', 'subplot.id')
                ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
                ->leftJoin('zona', 'hamparan.zona_id', '=', 'zona.id')
                // ->whereYear('tiang.created_at', $tahun)
                ->where('zona.polt_area_id', $zonaid)
                ->where('plot.status', 'aktif')
                ->groupBy('plot.id')
                ->select(
                    'plot.id',
                    DB::raw('AVG(tiang.bio_di_atas_tanah) as tiang_avg_bio_di_atas_tanah'),
                    DB::raw('AVG(tiang.kandungan_karbon) as tiang_avg_kandungan_karbon'),
                    DB::raw('AVG(tiang.co2) as tiang_avg_co2'),
                    DB::raw('COUNT(tiang.no_pohon) as total_pohon_tiang'),
                )
                ->get();
            $totalPlotTiang = count($tiang);
            // dd( $totalPlotTiang);
            $totalTiangCo2Keseluruhan = 0;
            $totalTiangKarbonKeseluruhan = 0;
            $totalTiangBiomassaKeseluruhan = 0;
            foreach ($tiang as $tiangg) {

                $constantTiang = 100;
                $TotalTiangCo2 = ($tiangg->tiang_avg_co2 * ($tiangg->total_pohon_tiang / $constantTiang) * 10000) / 1000;
                $TotalTiangKarbon = ($tiangg->tiang_avg_kandungan_karbon * ($tiangg->total_pohon_tiang / $constantTiang) * 10000) / 1000;
                $TotalTiangBiomassa = ($tiangg->tiang_avg_bio_di_atas_tanah * ($tiangg->total_pohon_tiang / $constantTiang) * 10000) / 1000;

                $totalTiangCo2Keseluruhan += $TotalTiangCo2;
                $totalTiangKarbonKeseluruhan += $TotalTiangKarbon;
                $totalTiangBiomassaKeseluruhan += $TotalTiangBiomassa;
            }
            $rataTiangCo22 = $totalPlotTiang ? $totalTiangCo2Keseluruhan / $totalPlotTiang : 0;
            $rataTiangKarbonn = $totalPlotTiang ? $totalTiangKarbonKeseluruhan / $totalPlotTiang : 0;
            $rataTiangBiomassaa = $totalPlotTiang ? $totalTiangBiomassaKeseluruhan / $totalPlotTiang : 0;
            // dd($rataPancangCo22);
            $pohon = DB::table('pohon')
                ->leftJoin('subplot', 'pohon.subplot_id', '=', 'subplot.id')
                ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
                ->leftJoin('zona', 'hamparan.zona_id', '=', 'zona.id')
                // ->whereYear('pohon.created_at', $tahun)
                ->where('zona.polt_area_id', $zonaid)
                ->where('plot.status', 'aktif')
                ->groupBy('plot.id')
                ->select(
                    'plot.id',
                    DB::raw('AVG(pohon.bio_di_atas_tanah) as pohon_avg_bio_di_atas_tanah'),
                    DB::raw('AVG(pohon.kandungan_karbon) as pohon_avg_kandungan_karbon'),
                    DB::raw('AVG(pohon.co2) as pohon_avg_co2'),
                    DB::raw('COUNT(pohon.no_pohon) as total_pohon'),
                )
                ->get();
            $totalPlotPohon = count($pohon);
            // dd( $totalPlotPohon);
            $totalPohonCo2Keseluruhan = 0;
            $totalPohonKarbonKeseluruhan = 0;
            $totalPohonBiomassaKeseluruhan = 0;
            foreach ($pohon as $pohonn) {

                $constantPohon = 400;
                $TotalPohonCo2 = ($pohonn->pohon_avg_co2 * ($pohonn->total_pohon / $constantPohon) * 10000) / 1000;
                $TotalPohonKarbon = ($pohonn->pohon_avg_kandungan_karbon * ($pohonn->total_pohon / $constantPohon) * 10000) / 1000;
                $TotalPohonBiomassa = ($pohonn->pohon_avg_bio_di_atas_tanah * ($pohonn->total_pohon / $constantPohon) * 10000) / 1000;

                $totalPohonCo2Keseluruhan += $TotalPohonCo2;
                $totalPohonKarbonKeseluruhan += $TotalPohonKarbon;
                $totalPohonBiomassaKeseluruhan += $TotalPohonBiomassa;
            }
            $rataPohonCo22 = $totalPlotPohon ? $totalPohonCo2Keseluruhan / $totalPlotPohon : 0;
            $rataPohonKarbonn = $totalPlotPohon ? $totalPohonKarbonKeseluruhan / $totalPlotPohon : 0;
            $rataPohonBiomassaa = $totalPlotPohon ? $totalPohonBiomassaKeseluruhan / $totalPlotPohon : 0;
            $rataPancangCo2 =  $faktor * $rataPancangCo22;
            $rataPancangKarbon = $faktor * $rataPancangKarbonn;
            $rataPancangBiomassa = $faktor * $rataPancangBiomassas;
            $rataTiangCo2 = $faktor * $rataTiangCo22;
            $rataTiangKarbon = $faktor * $rataTiangKarbonn;
            $rataTiangBiomassa = $faktor * $rataTiangBiomassaa;

            $rataPohonCo2 = $faktor * $rataPohonCo22;
            $rataPohonKarbon = $faktor * $rataPohonKarbonn;
            $rataPohonBiomassa = $faktor * $rataPohonBiomassaa;
            // // dd($rataPancangCo22);
            // dd([
            //     'Rata-rata Pancang CO2' => $rataPancangCo2,
            //     'Rata-rata Pancang Karbon' => $rataPancangKarbon,
            //     'Rata-rata Pancang Biomassa' => $rataPancangBiomassa,

            //     // 'Rata-rata Mangrove CO2' => $rataMangroveCo2,
            //     // 'Rata-rata Mangrove Karbon' => $rataMangroveKarbon,
            //     // 'Rata-rata Mangrove Biomassa' => $rataMangroveBiomassa,

            //     'Rata-rata Tiang CO2' => $rataTiangCo2,
            //     'Rata-rata Tiang Karbon' => $rataTiangKarbon,
            //     'Rata-rata Tiang Biomassa' => $rataTiangBiomassa,

            //     'Rata-rata Pohon CO2' => $rataPohonCo2,
            //     'Rata-rata Pohon Karbon' => $rataPohonKarbon,
            //     'Rata-rata Pohon Biomassa' => $rataPohonBiomassa,
            // ]);
            $UniqSerasah = DB::table('serasah')
                ->leftJoin('subplot', 'serasah.subplot_id', '=', 'subplot.id')
                ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
                ->leftJoin('zona', 'hamparan.zona_id', '=', 'zona.id')
                ->leftJoin('polt_area', 'zona.polt_area_id', '=', 'zona.id')
                // ->whereYear('serasah.created_at', $tahun)
                ->where('zona.polt_area_id', $zonaid)
                ->whereNotNull('plot.id')
                ->select(
                    // 'plot.nama_plot',
                    DB::raw("COUNT(DISTINCT plot.id) as total_plotserasah"),
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN serasah.co2 ELSE 0 END) as serasah_co2"),
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN serasah.kandungan_karbon ELSE 0 END) as serasah_kandungan_karbon"),
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN serasah.total_berat_kering ELSE 0 END) as serasah_total_berat_kering"),
                )
                ->first();
            $UniqSemai = DB::table('semai')
                ->leftJoin('subplot', 'semai.subplot_id', '=', 'subplot.id')
                ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
                ->leftJoin('zona', 'hamparan.zona_id', '=', 'zona.id')
                ->leftJoin('polt_area', 'zona.polt_area_id', '=', 'zona.id')
                // ->whereYear('semai.created_at', $tahun)
                ->where('zona.polt_area_id', $zonaid)
                ->whereNotNull('plot.id')
                ->select(
                    // 'plot.nama_plot',
                    DB::raw("COUNT(DISTINCT plot.id) as total_plotsmain"),
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN semai.co2 ELSE 0 END) as semai_co2"),
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN semai.kandungan_karbon ELSE 0 END) as semai_kandungan_karbon"),
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN semai.total_berat_kering ELSE 0 END) as semai_total_berat_kering"),
                )
                ->first();
            $UniqTumbuhanBawah = DB::table('tumbuhan_bawah')
                ->leftJoin('subplot', 'tumbuhan_bawah.subplot_id', '=', 'subplot.id')
                ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
                ->leftJoin('zona', 'hamparan.zona_id', '=', 'zona.id')
                ->leftJoin('polt_area', 'zona.polt_area_id', '=', 'zona.id')
                // ->whereYear('tumbuhan_bawah.created_at', $tahun)
                ->where('zona.polt_area_id', $zonaid)
                ->whereNotNull('plot.id')
                ->select(
                    // 'plot.nama_plot',
                    DB::raw("COUNT(DISTINCT plot.id) as total_plottumbuhan"),
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN tumbuhan_bawah.co2 ELSE 0 END) as tumbuhan_bawah_co2"),
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN tumbuhan_bawah.kandungan_karbon ELSE 0 END) as tumbuhan_bawah_kandungan_karbon"),
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN tumbuhan_bawah.total_berat_kering ELSE 0 END) as tumbuhan_bawah_total_berat_kering"),
                )
                ->first();
            $NUniqecromas = DB::table('necromass')
                ->leftJoin('subplot', 'necromass.subplot_id', '=', 'subplot.id')
                ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
                ->leftJoin('zona', 'hamparan.zona_id', '=', 'zona.id')
                ->leftJoin('polt_area', 'zona.polt_area_id', '=', 'zona.id')
                // ->whereYear('necromass.created_at', $tahun)
                ->where('zona.polt_area_id', $zonaid)
                ->whereNotNull('plot.id')
                ->select(
                    // 'plot.nama_plot',
                    DB::raw("COUNT(DISTINCT plot.id) as total_plotneromas"),
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN necromass.co2 ELSE 0 END) as necromass_co2"),
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN necromass.biomasa ELSE 0 END) as necromass_total_biomasa"),
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN necromass.carbon ELSE 0 END) as necromass_total_carbon")
                )
                ->first();
            // dd($UniqSemai->total_zona, $UniqSemai->semai_kandungan_karbon);
            $totalplotSerasah = optional($UniqSerasah)->total_plotserasah ?? 0;
            $totalplotsemai = optional($UniqSemai)->total_plotsmain ?? 0;
            $totalplotTumbuhan = optional($UniqTumbuhanBawah)->total_plottumbuhan ?? 0;
            $totalplotNekromas = optional($NUniqecromas)->total_plotneromas ?? 0;
            // dd($UniqSerasah->total_plotserasah);
            $hasilSerasahCo2 = $totalplotSerasah > 0 ? $UniqSerasah->serasah_co2 / $totalplotSerasah : 0;
            $Serasahco2 = ($hasilSerasahCo2 / 1000000) * 10000;
            // dd($hasilSerasahCo2);
            $hasilSerasahKarbon = $totalplotSerasah > 0 ? $UniqSerasah->serasah_kandungan_karbon / $totalplotSerasah : 0;
            $SerasahKarbon = ($hasilSerasahKarbon / 1000000) * 10000;

            $hasilSerasahberatkering = $totalplotSerasah > 0 ? $UniqSerasah->serasah_total_berat_kering / $totalplotSerasah : 0;

            $Serasahberatkering = ($hasilSerasahberatkering / 1000000) * 10000;
            // dd($hasilSerasahCo2, $hasilSerasahKarbon, $hasilSerasahberatkering );
            // semai


            $hasilsemaiCo2 = $totalplotsemai > 0 ? $UniqSemai->semai_co2 / $totalplotsemai : 0;

            $semaico2 = ($hasilsemaiCo2 / 1000000) * 10000;
            // dd($UniqSemai, $hasilsemaiCo2);
            $hasilsemaiKarbon = $totalplotsemai > 0 ? $UniqSemai->semai_kandungan_karbon / $totalplotsemai : 0;

            $semaiKarbon = ($hasilsemaiKarbon / 1000000) * 10000;
            // dd($UniqSemai, $hasilsemaiKarbon);
            $hasilsemaiberatkering = $totalplotsemai > 0 ? $UniqSemai->semai_total_berat_kering / $totalplotsemai : 0;

            $semaiberatkering = ($hasilsemaiberatkering / 1000000) * 10000;
            // tumbuhan bah
            $hasiltumbuhan_bawahCo2 = $totalplotTumbuhan > 0 ? $UniqTumbuhanBawah->tumbuhan_bawah_co2 / $totalplotTumbuhan : 0;

            $tumbuhan_bawahco2 = ($hasiltumbuhan_bawahCo2 / 1000000) * 10000;

            $hasiltumbuhan_bawahKarbon = $totalplotTumbuhan > 0 ? $UniqTumbuhanBawah->tumbuhan_bawah_kandungan_karbon / $totalplotTumbuhan : 0;

            $tumbuhan_bawahKarbon = ($hasiltumbuhan_bawahKarbon / 1000000) * 10000;

            $hasiltumbuhan_bawahberatkering = $totalplotTumbuhan > 0 ? $UniqTumbuhanBawah->tumbuhan_bawah_total_berat_kering / $totalplotTumbuhan : 0;

            $tumbuhan_bawahberatkering = ($hasiltumbuhan_bawahberatkering / 1000000) * 10000;


            // Konversi nilai Necromass

            $hasilNecromashCo2 = $totalplotNekromas > 0 ? $NUniqecromas->necromass_co2 / $totalplotNekromas : 0;

            $Necromassco2 = ($hasilNecromashCo2 / 1000000) * 10000 / 400;

            $hasilNecromasbiomasa = $totalplotNekromas > 0 ? $NUniqecromas->necromass_total_biomasa / $totalplotNekromas : 0;

            $Necromassbiomasa = ($hasilNecromasbiomasa / 1000000) * 10000 / 400;

            $hasilNecromascarbon = $totalplotNekromas > 0 ? $NUniqecromas->necromass_total_carbon / $totalplotNekromas : 0;

            $NecromassCarbon =  ($hasilNecromascarbon / 1000000) * 10000 / 400;

            // klandungan karbon
            $Biomassadiataspermukaantanah = $rataPancangBiomassa +  $rataTiangBiomassa + $rataPohonBiomassa + $Serasahberatkering +  $semaiberatkering +  $tumbuhan_bawahberatkering +   $Necromassbiomasa;
            $Kandungankarbon = $rataPancangKarbon +  $rataTiangKarbon + $rataPohonKarbon + $SerasahKarbon +  $semaiKarbon + $tumbuhan_bawahKarbon + $NecromassCarbon;
            $SerapanCO2  = $rataPancangCo2 + $rataTiangCo2 +   $rataPohonCo2 +  $Serasahco2 +  $semaico2 +  $tumbuhan_bawahco2 +  $Necromassco2;
            // TootaL Karbon
            $TotalKandunganKarbon =  $tanahh->total_carbon_tanah + $hasilNecromascarbon + $SerasahKarbon + $semaiKarbon  + $tumbuhan_bawahKarbon + $rataPohonKarbon + $rataPancangKarbon + $rataTiangKarbon;
            // Total carbon tanama kandungan karbon
            $TotalCarbon =  $semaico2   + $rataPohonCo2 + $rataPancangCo2 + $rataTiangCo2 + $tumbuhan_bawahco2;
            // serapan co2
            // Total berat biomassa tanaman/ AKAR
            $totalBerat = $rataPancangCo2 + $rataTiangCo2 + $rataPohonCo2;
            $beratMasaAkar = $totalBerat * 0.37;
            // total karbon ]
            $KarbonCo2 = $rataPancangCo2 + $beratMasaAkar + $rataTiangCo2 + $rataPohonCo2  + $Serasahco2 + $semaico2 + $tumbuhan_bawahco2 + $Necromassco2;
            // Pendekatan Kerapatan

            // Total CO2 dari tanaman
            $Co2Tanamannn = $rataPancangCo2 + $rataTiangCo2 + $rataPohonCo2;
            $totalCo2Lokasi = $Co2Tanamannn * $faktor;

            // Faktor konversi CO2
            $Serasa = $Serasahco2 * $faktor;
            $Necromass = $Necromassco2 * $faktor;
            $co2tanaman = $TotalCarbon * $faktor;
            $akar = $beratMasaAkar * 1.00; // Asumsi biomassa akar tanpa perubahan
            $tanah = $tanahh->total_co2_tanah * 1.00;
            // $tanah = $zona->total_co2_tanah * $fa
            // Total Karbon
            $TotalKarbon5POL = $Serasa + $Necromass + $co2tanaman + $tanah + $akar;
            // Perhitungan Baseline Lahan Kosong
            $BaselineLahanKosong = $TotalKarbon5POL - (((10 + 4) / 2) * $faktor);
            // persen
            // $hasilSerasahPersen = ($Serasa != 0) ? ($TotalKarbon5POL / $Serasa) * 100 : 0;
            // $hasilNecromassPersen = ($Necromass != 0) ? ($TotalKarbon5POL / $Necromass) * 100 : 0;
            // $hasilco2tanamanPersen = ($co2tanaman != 0) ? ($TotalKarbon5POL / $co2tanaman) * 100 : 0;
            // $hasilakarPersen = ($akar != 0) ? ($TotalKarbon5POL / $akar) * 100 : 0;
            // $hasiltanahPersen = ($tanah != 0) ? ($TotalKarbon5POL / $tanah) * 100 : 0;
            $hasilSerasahPersen = ($BaselineLahanKosong != 0) ? ($Serasa / $BaselineLahanKosong) * 100 : 0;
            $hasilNecromassPersen = ($BaselineLahanKosong != 0) ? ($Necromass / $BaselineLahanKosong) * 100 : 0;
            $hasilco2tanamanPersen = ($BaselineLahanKosong != 0) ? ($co2tanaman / $BaselineLahanKosong) * 100 : 0;
            $hasilakarPersen = ($BaselineLahanKosong != 0) ? ($akar / $BaselineLahanKosong) * 100 : 0;
            $hasiltanahPersen = ($BaselineLahanKosong != 0) ? ($tanah / $BaselineLahanKosong) * 100 : 0;

            return [
                'dareah' => $zona->daerah,
                'latitude' => $zona->latitude,
                'longitude' => $zona->longitude,
                'Biomassadiataspermukaantanah' => number_format($Biomassadiataspermukaantanah * 1000, 2, '.', ''),
                'Kandungankarbon' => number_format($Kandungankarbon * 1000, 2, '.', ''),
                'SerapanCO2' => number_format($SerapanCO2 * 1000, 2, '.', ''),
                'TotalPancangco2' => number_format($rataPancangCo2 * 1000, 2, '.', ''),
                'TotalPancangkarbon' => number_format($rataPancangKarbon * 1000, 2, '.', ''),
                // 'TotalMangroveKarbondioksida' => number_format($TotalMangroveKarbondioksida * 1000 , 2, '.', ''),
                // 'TotalMangrovekarbon' => number_format($TotalMangrovekarbon * 1000 , 2, '.', ''),
                'TotalTiangco2' => number_format($rataTiangCo2 * 1000, 2, '.', ''),
                'TotalTiangKarbon' => number_format($rataTiangKarbon * 1000, 2, '.', ''),
                'TotalPohonco2' => number_format($rataPohonCo2 * 1000, 2, '.', ''),
                'TotalPohonkarbon' => number_format($rataPohonKarbon * 1000, 2, '.', ''),
                'Serasahco2' => number_format($Serasahco2 * 1000, 2, '.', ''),
                'SerasahKarbon' => number_format($SerasahKarbon * 1000, 2, '.', ''),
                'semaico2' => number_format($semaico2 * 1000, 2, '.', ''),
                'semaiKarbon' => number_format($semaiKarbon * 1000, 2, '.', ''),
                'tumbuhanbawahco2' => number_format($tumbuhan_bawahco2 * 1000, 2, '.', ''),
                'tumbuhanbawahkarbon' => number_format($tumbuhan_bawahKarbon * 1000, 2, '.', ''),
                'Necromassco2' => number_format($Necromassco2 * 1000, 2, '.', ''),
                'NecromassCarbon' => number_format($hasilNecromascarbon * 1000, 2, '.', ''),
                'TotalKandunganKarbon' => number_format($TotalKandunganKarbon * 1000, 2, '.', ''),
                'KarbonCo2' => number_format($KarbonCo2 * 1000, 2, '.', ''),
                'TotalCarbonn' => number_format($TotalCarbon * 1000, 2, '.', ''),
                'Serasah' => number_format($Serasa * 1000, 2, '.', ''),
                'Necromass' => number_format($Necromass * 1000, 1, '.', ''),
                'Co2Tanaman' => number_format($co2tanaman * 1000, 1, '.', ''),
                'TanahCo2' => number_format($tanahh->total_co2_tanah * 1000, 2, '.', ''),
                'TanahCarbon' => number_format($tanahh->total_carbon_tanah * 1000, 2, '.', ''),
                'BeratBiomassaAkar' => number_format($akar * 1000, 2, '.', ''),
                'tanah' => number_format($tanah * 1000, 1, '.', ''),
                'beratMasaAkar' => number_format($beratMasaAkar * 1000, 2, '.', ''),
                'faktor' => number_format($faktor ?? 0, 0, '.', ''),
                'TotalKaoobon' => number_format($TotalKarbon5POL * 1000, 2, '.', ''),
                'BaselineLahanKosong' => number_format($BaselineLahanKosong * 1000, 2, '.', ''),
                'hasilSerasahPersen' => number_format($hasilSerasahPersen * 1, 2, '.', ''),
                'hasilNecromassPersen' => number_format($hasilNecromassPersen * 1, 2, '.', ''),
                'hasilco2tanamanPersen' => number_format($hasilco2tanamanPersen * 1, 2, '.', ''),
                'hasilakarPersen' => number_format($hasilakarPersen * 1, 2, '.', ''),
                'hasiltanahPersen' => number_format($hasiltanahPersen * 1, 2, '.', ''),
                'tahun' => $tahun,
            ];

            // return view('dashboard', [
            //     'ringkasann' => $ringkasann,
            //     'tahun' => $tahun, // pastikan dikirim dari controller
            // ]);
            // // dd($zon  a, $TotalPancangco2, $TotalPancangkarbon, $TotalMangroveKarbondioksida);
        });
        // keselluhan

        // dd($ringkasan);
        // dd($ringkasann);
        $Serasah = DB::table('serasah')
            ->leftJoin('subplot', 'serasah.subplot_id', '=', 'subplot.id')
            ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
            ->where('plot.status', 'aktif')
            ->get();
        $Semai = DB::table('semai')
            ->leftJoin('subplot', 'semai.subplot_id', '=', 'subplot.id')
            ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
            ->where('plot.status', 'aktif')
            ->get();
        $TumbuhanBawah = DB::table('tumbuhan_bawah')
            ->leftJoin('subplot', 'tumbuhan_bawah.subplot_id', '=', 'subplot.id')
            ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
            ->where('plot.status', 'aktif')
            ->get();
        $pancang = DB::table('pancang')
            ->leftJoin('subplot', 'pancang.subplot_id', '=', 'subplot.id')
            ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
            ->where('plot.status', 'aktif')
            ->get();
        $tiang = DB::table('tiang')
            ->leftJoin('subplot', 'tiang.subplot_id', '=', 'subplot.id')
            ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
            ->where('plot.status', 'aktif')
            ->get();
        $pohon = DB::table('pohon')
            ->leftJoin('subplot', 'pohon.subplot_id', '=', 'subplot.id')
            ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
            ->where('plot.status', 'aktif')
            ->get();
        $Necromas = DB::table('necromass')
            ->leftJoin('subplot', 'necromass.subplot_id', '=', 'subplot.id')
            ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
            ->where('plot.status', 'aktif')
            ->get();
        $tanah = DB::table('tanah')
            ->leftJoin('subplot', 'tanah.subplot_id', '=', 'subplot.id')
            ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
            ->where('plot.status', 'aktif')
            ->get();

        return view('dashboard', compact(
            'user',
            'dataDaerah',
            // 'poltArea',
            'ringkasann',
            'Serasah',
            'Semai',
            'TumbuhanBawah',
            'Necromas',
            'pancang',
            'tiang',
            'pohon',
            'tanah',
            'tahun',
        ));

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
    // public function showChartPie(Request $request)
    // {
    //     $user = Auth::user();
    //     $dataDaerah = PoltArea::pluck('daerah')->toArray();
    // $ringkasan = Zona::leftJoin('polt_area', 'zona.polt_area_id', '=', 'polt_area.id')
    //     ->leftJoin('hamparan', 'hamparan.zona_id', '=', 'zona.id')
    //     ->leftJoin('plot', 'plot.hamparan_id', '=', 'hamparan.id')
    //     ->leftJoin('subplot', 'subplot.plot_id', '=', 'plot.id')

    //     // Semua entitas yang berhubungan dengan subplot
    //     ->leftJoin('pancang', 'pancang.subplot_id', '=', 'subplot.id')
    //     ->leftJoin('tiang', 'tiang.subplot_id', '=', 'subplot.id')
    //     ->leftJoin('pohon', 'pohon.subplot_id', '=', 'subplot.id')
    //     ->leftJoin('serasah', 'serasah.subplot_id', '=', 'subplot.id')
    //     ->leftJoin('semai', 'semai.subplot_id', '=', 'subplot.id')
    //     ->leftJoin('necromass', 'necromass.subplot_id', '=', 'subplot.id')
    //     ->leftJoin('tanah', 'tanah.subplot_id', '=', 'subplot.id')
    //     ->leftJoin('tumbuhan_bawah', 'tumbuhan_bawah.subplot_id', '=', 'subplot.id')
    //     ->leftJoin('mangrove', 'mangrove.subplot_id', '=', 'subplot.id')
    //     ->select(
    //         'polt_area.daerah',
    //         DB::raw('AVG(pancang.bio_di_atas_tanah) as pancang_avg_bio_di_atas_tanah'),
    //         DB::raw('AVG(pancang.kandungan_karbon) as pancang_avg_kandungan_karbon'),
    //         DB::raw('AVG(pancang.co2) as pancang_avg_co2'),
    //         DB::raw('COUNT(pancang.no_pohon) as total_pohon_pancang'),
    //         // Tiang
    //         DB::raw('AVG(tiang.bio_di_atas_tanah) as tiang_avg_bio_di_atas_tanah'),
    //         DB::raw('AVG(tiang.kandungan_karbon) as tiang_avg_kandungan_karbon'),
    //         DB::raw('AVG(tiang.co2) as tiang_avg_co2'),
    //         DB::raw('COUNT(tiang.no_pohon) as total_tiang'),
    //         // Pohon
    //         DB::raw('AVG(pohon.bio_di_atas_tanah) as pohon_avg_bio_di_atas_tanah'),
    //         DB::raw('AVG(pohon.co2) as pohon_avg_co2'),
    //         DB::raw('AVG(pohon.kandungan_karbon) as pohon_avg_kandungan_karbon'),
    //         DB::raw('COUNT(pohon.no_pohon) as total_pohon'),
    //         // mangrove
    //         DB::raw('SUM(mangrove.biomasa) as mangrove_avg_biomasa'),
    //         DB::raw('SUM(mangrove.karbondioksida) as mangrove_avg_karbondioksida'),
    //         DB::raw('SUM(mangrove.kandungan_karbon) as mangrove_avg_kandungan_karbon'),
    //         DB::raw('COUNT(mangrove.no_pohon) as total_mangrove'),
    //         // Tanah
    //         DB::raw('SUM(tanah.carbonkg) as total_carbon_tanah'),
    //         DB::raw('SUM(tanah.co2kg) as total_co2_tanah')
    //     )
    //     // ->where('slug',$slug)
    //     ->groupBy('polt_area.id', 'polt_area.luas_lokasi')
    //     ->get()
    //     ->map(fn($item) => (object) $item);
    // // Lakukan perhitungan tambahan untuk masing-masing zona
    // $ringkasan = $ringkasan->map(function ($zona) {
    //     $faktor =   $zona->luas_lokasi ?? 11.5;
    //     // $faktor =  max((float) $zona->luas_lokasi, 11.5);
    //     // Perhitungan Pancang
    //     $constantPancang = 25;
    //     $TotalPancangco2 = ($zona->pancang_avg_co2 * ($zona->total_pohon_pancang / $constantPancang) * 10000) / 1000;
    //     $TotalPancangkarbon = ($zona->pancang_avg_kandungan_karbon * ($zona->total_pohon_pancang / $constantPancang) * 10000) / 1000;
    //     $TotalPancangbiomimasa = ($zona->pancang_avg_bio_di_atas_tanah * ($zona->total_pohon_pancang / $constantPancang) * 10000) / 1000;
    //     // Perhitungan Mangrove
    //     $constantMangrove = 25;
    //     $TotalMangroveKarbondioksida = ($zona->mangrove_avg_karbondioksida * ($zona->total_mangrove / $constantMangrove) * 10000) / 1000;
    //     $TotalMangrovekarbon = ($zona->mangrove_avg_kandungan_karbon * ($zona->total_mangrove / $constantMangrove) * 10000) / 1000;
    //     $TotalMangrovebiomimasa = ($zona->mangrove_avg_biomasa * ($zona->total_mangrove / $constantMangrove) * 10000) / 1000;

    //     // Perhitungan Tiang
    //     $constantTiang = 100;
    //     $TotalTiangco2 = ($zona->tiang_avg_co2 * ($zona->total_tiang / $constantTiang) * 10000) / 1000;
    //     $TotalTiangKarbon = ($zona->tiang_avg_kandungan_karbon * ($zona->total_tiang / $constantTiang) * 10000) / 1000;
    //     $TotalTiangbiomasa = ($zona->tiang_avg_bio_di_atas_tanah * ($zona->total_tiang / $constantTiang) * 10000) / 1000;

    //     // Perhitungan Pohon
    //     $constantPohon = 400;
    //     $TotalPohonco2 = ($zona->pohon_avg_co2 * ($zona->total_pohon / $constantPohon) * 10000) / 1000;
    //     $TotalPohonkarbon = ($zona->pohon_avg_kandungan_karbon * ($zona->total_pohon / $constantPohon) * 10000) / 1000;
    //     $TotalPohonbiomasa = ($zona->pohon_avg_bio_di_atas_tanah * ($zona->total_pohon / $constantPohon) * 10000) / 1000;
    //     // Perhitungan CO2 dari Serasah (dibagi berdasarkan jumlah nilai unik)
    //     $uniqueSerasah = DB::table('serasah')
    //         ->leftJoin('subplot', 'serasah.subplot_id', '=', 'subplot.id')
    //         ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
    //         ->leftJoin('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
    //         ->leftJoin('zona', 'hamparan.zona_id', '=', 'zona.id')
    //         ->select('zona.zona as nama_zona', DB::raw('COUNT(DISTINCT serasah.id) as total_serasah'))
    //         ->groupBy('zona.zona')
    //         ->get();
    //     $uniqueSemai = DB::table('semai')
    //         ->leftJoin('subplot', 'semai.subplot_id', '=', 'subplot.id') // Perbaikan: Menghubungkan semai ke subplot
    //         ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
    //         ->leftJoin('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
    //         ->leftJoin('zona', 'hamparan.zona_id', '=', 'zona.id')
    //         ->select('zona.zona as nama_zona', DB::raw('COUNT(DISTINCT semai.id) as total_semai'))
    //         ->groupBy('zona.zona') // Mengelompokkan berdasarkan nama zona
    //         ->get();
    //     $uniqueTumbuhanBawah = DB::table('tumbuhan_bawah')
    //         ->leftJoin('subplot', 'tumbuhan_bawah.subplot_id', '=', 'subplot.id')
    //         ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
    //         ->leftJoin('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
    //         ->leftJoin('zona', 'hamparan.zona_id', '=', 'zona.id')
    //         ->select('zona.zona as nama_zona', DB::raw('COUNT(DISTINCT tumbuhan_bawah.id) as total_tumbuhan_bawah'))
    //         ->groupBy('zona.zona') // Mengelompokkan berdasarkan nama zona
    //         ->get();
    //     $uniqueNecromas = DB::table('necromass')
    //         ->leftJoin('subplot', 'necromass.subplot_id', '=', 'subplot.id')
    //         ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
    //         ->leftJoin('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
    //         ->leftJoin('zona', 'hamparan.zona_id', '=', 'zona.id')
    //         ->select('zona.zona as nama_zona', DB::raw('COUNT(DISTINCT necromass.id) as total_necromass'))
    //         ->groupBy('zona.zona') // Mengelompokkan berdasarkan nama zona
    //         ->get();

    //     $zonaa = Zona::select(
    //         DB::raw('SUM(serasah.co2) as serasah_co2'),
    //         DB::raw('SUM(serasah.kandungan_karbon) as serasah_kandungan_karbon'),
    //         DB::raw('SUM(serasah.total_berat_kering) as serasah_total_berat_kering'),

    //         DB::raw('SUM(semai.co2) as semai_co2'),
    //         DB::raw('SUM(semai.kandungan_karbon) as semai_kandungan_karbon'),
    //         DB::raw('SUM(semai.total_berat_kering) as semai_total_berat_kering'),

    //         DB::raw('SUM(tumbuhan_bawah.co2) as tumbuhan_bawah_co2'),
    //         DB::raw('SUM(tumbuhan_bawah.kandungan_karbon) as tumbuhan_bawah_kandungan_karbon'),
    //         DB::raw('SUM(tumbuhan_bawah.total_berat_kering) as tumbuhan_bawah_total_berat_kering'),

    //         DB::raw('SUM(necromass.co2) as necromass_co2'),
    //         DB::raw('SUM(necromass.biomasa) as necromass_total_biomasa'),
    //         DB::raw('SUM(necromass.carbon) as necromass_total_carbon')
    //     )
    //         ->leftJoin('hamparan', 'hamparan.zona_id', '=', 'zona.id')

    //         ->leftJoin('plot', 'plot.hamparan_id', '=', 'hamparan.id')
    //         ->leftJoin('subplot', 'subplot.plot_id', '=', 'plot.id')
    //         ->leftJoin('serasah', 'serasah.subplot_id', '=', 'subplot.id')
    //         ->leftJoin('semai', 'semai.subplot_id', '=', 'subplot.id')
    //         ->leftJoin('tumbuhan_bawah', 'tumbuhan_bawah.subplot_id', '=', 'subplot.id')
    //         ->leftJoin('necromass', 'necromass.subplot_id', '=', 'subplot.id')
    //         ->whereNull('zona.deleted_at')
    //         ->first(); //Ambil satu objek, bukan Collection
    //     // dd($zonaa);
    //     // dd($uniqueSerasah, $uniqueSemai, $uniqueTumbuhanBawah, $uniqueNecromas);
    //     $jumlahSerasah = $uniqueSerasah->first()->total_serasah ?? 0;
    //     $hasilSerasahCo2 = ($jumlahSerasah > 0) ? ($totalZona > 0 ?$zonaa->serasah_co2 / $jumlahSerasah) : 0;
    //     $Serasahco2 = ((float) $hasilSerasahCo2 / 1000000) * 10000;

    //     $hasilSerasahKarbon = ($jumlahSerasah > 0) ? ($zonaa->serasah_kandungan_karbon / $jumlahSerasah) : 0;
    //     $SerasahKarbon = ((float) $hasilSerasahKarbon / 1000000) * 10000;

    //     $hasilSerasahberatkering = ($jumlahSerasah > 0) ? ($zonaa->serasah_total_berat_kering / $jumlahSerasah) : 0;
    //     $Serasahberatkering = ((float) $hasilSerasahberatkering / 1000000) * 10000;
    //     // semai
    //     $jumlahSemai = $uniqueSemai->first()->total_semai ?? 0;

    //     $hasilsemaiCo2 = ($jumlahSemai > 0) ? ($zonaa->semai_co2 / $jumlahSemai) : 0;
    //     $semaico2 = ((float) $hasilsemaiCo2 / 1000000) * 10000;

    //     $hasilsemaiKarbon = ($jumlahSemai > 0) ? ($zonaa->semai_kandungan_karbon / $jumlahSemai) : 0;
    //     $semaiKarbon = ((float) $hasilsemaiKarbon / 1000000) * 10000;

    //     $hasilsemaiberatkering = ($jumlahSemai > 0) ? ($zonaa->semai_total_berat_kering / $jumlahSemai) : 0;
    //     $semaiberatkering = ((float) $hasilsemaiberatkering / 1000000) * 10000;
    //     // tumbuhan bah
    //     $jumlahTumbuhanBawah = $uniqueTumbuhanBawah->first()->total_tumbuhan_bawah ?? 0;
    //     $hasiltumbuhan_bawahCo2 = ($jumlahTumbuhanBawah > 0) ? ($zonaa->tumbuhan_bawah_co2 / $jumlahTumbuhanBawah) : 0;
    //     $tumbuhan_bawahco2 = ((float) $hasiltumbuhan_bawahCo2 / 1000000) * 10000;

    //     $hasiltumbuhan_bawahKarbon = ($jumlahTumbuhanBawah > 0) ? ($zonaa->tumbuhan_bawah_kandungan_karbon / $jumlahTumbuhanBawah) : 0;
    //     $tumbuhan_bawahKarbon = ((float) $hasiltumbuhan_bawahKarbon / 1000000) * 10000;

    //     $hasiltumbuhan_bawahberatkering = ($jumlahTumbuhanBawah > 0) ? ($zonaa->tumbuhan_bawah_total_berat_kering / $jumlahTumbuhanBawah) : 0;
    //     $tumbuhan_bawahberatkering = ((float) $hasiltumbuhan_bawahberatkering / 1000000) * 10000;


    //     // Konversi nilai Necromass
    //     $jumlahNecromas = $uniqueNecromas->first()->total_necromass ?? 0;

    //     $hasilNecromashCo2 = ($jumlahNecromas > 0) ? ($zonaa->necromass_co2 / $jumlahNecromas) : 0;
    //     $Necromassco2 = ((float) $hasilNecromashCo2 / 1000000) * 10000 / 400;

    //     $hasilNecromasbiomasa = ($jumlahNecromas > 0) ? ($zonaa->necromass_total_biomasa / $jumlahNecromas) : 0;
    //     $Necromassbiomasa = ((float) $hasilNecromasbiomasa / 1000000) * 10000 / 400;

    //     $hasilNecromascarbon = ($jumlahNecromas > 0) ? ($zonaa->necromass_total_carbon / $jumlahNecromas) : 0;
    //     $NecromassCarbon = ((float) $hasilNecromascarbon / 1000000) * 10000 / 400;
    //     // klandungan karbon
    //     $Biomassadiataspermukaantanah = $TotalPancangbiomimasa +  $TotalTiangbiomasa + $TotalPohonbiomasa + $Serasahberatkering +  $semaiberatkering +  $tumbuhan_bawahberatkering +   $Necromassbiomasa;
    //     $Kandungankarbon = $TotalPancangkarbon +  $TotalTiangKarbon + $TotalPohonkarbon + $SerasahKarbon +  $semaiKarbon + $tumbuhan_bawahKarbon + $NecromassCarbon;
    //     $SerapanCO2  = $TotalPancangco2 + $TotalTiangco2 +   $TotalPohonco2 +  $Serasahco2 +  $semaico2 +  $tumbuhan_bawahco2 +  $Necromassco2;
    //     // TootaL Karbon
    //     $TotalKandunganKarbon =  $zona->total_carbon_tanah + $NecromassCarbon + $SerasahKarbon + $semaiKarbon  + $tumbuhan_bawahKarbon + $TotalPohonkarbon + $TotalPancangkarbon + $TotalTiangKarbon;
    //     // Total carbon tanama kandungan karbon
    //     $TotalCarbon =  $semaico2   + $TotalPohonco2 + $TotalPancangco2 + $TotalTiangco2 + $tumbuhan_bawahco2;
    //     // serapan co2
    //     // Total berat biomassa tanaman/ AKAR
    //     $totalBerat = $TotalPancangco2 + $TotalTiangco2 + $TotalPohonco2;
    //     $beratMasaAkar = $totalBerat * 0.37;
    //     // total karbon ]
    //     $KarbonCo2 = $TotalPancangco2 + $beratMasaAkar + $TotalTiangco2 + $TotalPohonco2  + $Serasahco2 + $semaico2 + $tumbuhan_bawahco2;
    //     // Pendekatan Kerapatan

    //     // Total CO2 dari tanaman
    //     $Co2Tanamannn = $TotalPancangco2 + $TotalTiangco2 + $TotalPohonco2;
    //     $totalCo2Lokasi = $Co2Tanamannn * $faktor;

    //     // Faktor konversi CO2
    //     $Serasa = $Serasahco2 * $faktor;
    //     $Necromass = $Necromassco2 * $faktor;
    //     $co2tanaman = $Co2Tanamannn * $faktor;
    //     $akar = $beratMasaAkar * $faktor; // Asumsi biomassa akar tanpa perubahan
    //     $tanah = $zona->total_co2_tanah * $faktor;
    //     $tanah = $zona->total_co2_tanah * $faktor;
    //     // Total Karbon
    //     $TotalKarbon5POL = $Serasa + $Necromass + $co2tanaman + $tanah + $akar;
    //     // Perhitungan Baseline Lahan Kosong
    //     $BaselineLahanKosong = $TotalKarbon5POL - (((10 + 4) / 2) * $faktor);
    //     // persen
    //     // $hasilSerasahPersen = ($Serasa != 0) ? ($TotalKarbon5POL / $Serasa) * 100 : 0;
    //     // $hasilNecromassPersen = ($Necromass != 0) ? ($TotalKarbon5POL / $Necromass) * 100 : 0;
    //     // $hasilco2tanamanPersen = ($co2tanaman != 0) ? ($TotalKarbon5POL / $co2tanaman) * 100 : 0;
    //     // $hasilakarPersen = ($akar != 0) ? ($TotalKarbon5POL / $akar) * 100 : 0;
    //     // $hasiltanahPersen = ($tanah != 0) ? ($TotalKarbon5POL / $tanah) * 100 : 0;
    //     $hasilSerasahPersen = ($BaselineLahanKosong != 0) ? ($Serasa / $BaselineLahanKosong) * 100 : 0;
    //     $hasilNecromassPersen = ($BaselineLahanKosong != 0) ? ($Necromass / $BaselineLahanKosong) * 100 : 0;
    //     $hasilco2tanamanPersen = ($BaselineLahanKosong != 0) ? ($co2tanaman / $BaselineLahanKosong) * 100 : 0;
    //     $hasilakarPersen = ($BaselineLahanKosong != 0) ? ($akar / $BaselineLahanKosong) * 100 : 0;
    //     $hasiltanahPersen = ($BaselineLahanKosong != 0) ? ($tanah / $BaselineLahanKosong) * 100 : 0;

    //     return [
    //         // 'zona' => $zona->zona_nama,
    //         // 'Biomassadiataspermukaantanah' => number_format($Biomassadiataspermukaantanah ?? 0, 3, '.', ''),
    //         // 'Kandungankarbon' => number_format($Kandungankarbon ?? 0, 3, '.', ''),
    //         // 'SerapanCO2' => number_format($SerapanCO2 ?? 0, 3, '.', ''),
    //         'TotalPancangco2' => number_format($TotalPancangco2 ?? 0, 3, '.', ''),
    //         'TotalPancangkarbon' => number_format($TotalPancangkarbon ?? 0, 3, '.', ''),
    //         'TotalMangroveKarbondioksida' => number_format($TotalMangroveKarbondioksida ?? 0, 3, '.', ''),
    //         'TotalMangrovekarbon' => number_format($TotalMangrovekarbon ?? 0, 3, '.', ''),
    //         'TotalTiangco2' => number_format($TotalTiangco2 ?? 0, 3, '.', ''),
    //         'TotalTiangKarbon' => number_format($TotalTiangKarbon ?? 0, 3, '.', ''),
    //         'TotalPohonco2' => number_format($TotalPohonco2 ?? 0, 3, '.', ''),
    //         'TotalPohonkarbon' => number_format($TotalPohonkarbon ?? 0, 3, '.', ''),
    //         'Serasahco2' => number_format($Serasahco2 ?? 0, 3, '.', ''),
    //         'SerasahKarbon' => number_format($SerasahKarbon ?? 0, 3, '.', ''),
    //         'semaico2' => number_format($semaico2 ?? 0, 3, '.', ''),
    //         'semaiKarbon' => number_format($semaiKarbon ?? 0, 3, '.', ''),
    //         'tumbuhanbawahco2' => number_format($tumbuhan_bawahco2 ?? 0, 3, '.', ''),
    //         'tumbuhanbawahkarbon' => number_format($tumbuhan_bawahKarbon ?? 0, 3, '.', ''),
    //         'Necromassco2' => number_format($Necromassco2 ?? 0, 3, '.', ''),
    //         'NecromassCarbon' => number_format($NecromassCarbon ?? 0, 3, '.', ''),
    //         'TotalKandunganKarbon' => number_format($TotalKandunganKarbon ?? 0, 3, '.', ''),
    //         'KarbonCo2' => number_format($KarbonCo2 ?? 0, 3, '.', ''),
    //         'TotalCarbonn' => number_format($TotalCarbon ?? 0, 3, '.', ''),
    //         'Serasah' => number_format($Serasa ?? 0, 3, '.', ''),
    //         'Necromass' => number_format($Necromass ?? 0, 3, '.', ''),
    //         'Co2Tanaman' => number_format($co2tanaman ?? 0, 3, '.', ''),
    //         'TanahCo2' => number_format($zona->total_co2_tanah ?? 0, 4, '.', ''),
    //         'TanahCarbon' => number_format($zona->total_carbon_tanah ?? 0, 4, '.', ''),
    //         'BeratBiomassaAkar' => number_format($akar ?? 0, 4, '.', ''),
    //         'tanah' => number_format($tanah ?? 0, 4, '.', ''),
    //         'beratMasaAkar' => number_format($beratMasaAkar ?? 0, 4, '.', ''),
    //         'faktor' => number_format($faktor ?? 0, 0, '.', ''),
    //         'TotalKaoobon' => number_format($TotalKarbon5POL ?? 0, 4, '.', ''),
    //         'BaselineLahanKosong' => number_format($BaselineLahanKosong ?? 0, 2, '.', ''),
    //         'hasilSerasahPersen' => number_format($hasilSerasahPersen ?? 0, 2, '.', ''),
    //         'hasilNecromassPersen' => number_format($hasilNecromassPersen ?? 0, 2, '.', ''),
    //         'hasilco2tanamanPersen' => number_format($hasilco2tanamanPersen ?? 0, 2, '.', ''),
    //         'hasilakarPersen' => number_format($hasilakarPersen ?? 0, 2, '.', ''),
    //         'hasiltanahPersen' => number_format($hasiltanahPersen ?? 0, 2, '.', ''),
    //     ];
    //     // dd($zon  a, $TotalPancangco2, $TotalPancangkarbon, $TotalMangroveKarbondioksida);
    // });
    //     return view('dashboard', compact('user', 'dataDaerah', 'ringkasan'));
    //     // $tahun = $request->input('tahun', date('Y')); // Default tahun sekarang jika tidak ada input

    //     //     // Ambil daftar daerah dari database
    //     //     $dataDaerah  = DB::table('serasah')
    //     //     ->join('subplot', 'serasah.subplot_id', '=', 'subplot.id')
    //     //     ->join('beabbs', 'subplot.beabbs_id', '=', 'beabbs.id')
    //     //     ->join('plot', 'beabbs.plot_id', '=', 'plot.id')
    //     //     ->join('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
    //     //     ->join('zona', 'hamparan.zona_id', '=', 'zona.id')
    //     //     ->join('polt_area', 'zona.polt_area_id', '=', 'polt_area.id')
    //     //     ->select('polt_area.daerah as nama', DB::raw('SUM(serasah.carbon_stock) as total_carbon'))
    //     //     ->whereYear('serasah.created_at', $tahun)
    //     //     ->groupBy('polt_area.daerah')
    //     //     ->get();

    //     //     // Ambil data total karbon per daerah
    //     //     $carbonData = DB::table('serasah')
    //     //         ->select('daerah', DB::raw('SUM(carbon_stock) as total_carbon'))
    //     //         ->whereYear('created_at', $tahun)
    //     //         ->groupBy('daerah')
    //     //         ->union(DB::table('pancang')->select('daerah', DB::raw('SUM(carbon_stock) as total_carbon'))->whereYear('created_at', $tahun)->groupBy('daerah'))
    //     //         ->union(DB::table('tiang')->select('daerah', DB::raw('SUM(carbon_stock) as total_carbon'))->whereYear('created_at', $tahun)->groupBy('daerah'))
    //     //         ->union(DB::table('pohon')->select('daerah', DB::raw('SUM(carbon_stock) as total_carbon'))->whereYear('created_at', $tahun)->groupBy('daerah'))
    //     //         ->get()
    //     //         ->groupBy('daerah')
    //     //         ->map(function ($items) {
    //     //             return $items->sum('total_carbon');
    //     //         });

    //     //     // Ambil data total serapan karbon per daerah
    //     //     $absorptionData = DB::table('serasah')
    //     //         ->select('daerah', DB::raw('SUM(carbon_absorption) as total_absorption'))
    //     //         ->whereYear('created_at', $tahun)
    //     //         ->groupBy('daerah')
    //     //         ->union(DB::table('pancang')->select('daerah', DB::raw('SUM(carbon_absorption) as total_absorption'))->whereYear('created_at', $tahun)->groupBy('daerah'))
    //     //         ->union(DB::table('tiang')->select('daerah', DB::raw('SUM(carbon_absorption) as total_absorption'))->whereYear('created_at', $tahun)->groupBy('daerah'))
    //     //         ->union(DB::table('pohon')->select('daerah', DB::raw('SUM(carbon_absorption) as total_absorption'))->whereYear('created_at', $tahun)->groupBy('daerah'))
    //     //         ->get()
    //     //         ->groupBy('daerah')
    //     //         ->map(function ($items) {
    //     //             return $items->sum('total_absorption');
    //     //         });

    //     //     // Format data agar sesuai dengan grafik
    //     //     $carbonValues = [];
    //     //     $absorptionValues = [];

    //     //     foreach ($dataDaerah as $daerah) {
    //     //         $carbonValues[] = $carbonData[$daerah] ?? 0;
    //     //         $absorptionValues[] = $absorptionData[$daerah] ?? 0;
    //     //     }

    //     //     return view('chart', [
    //     //         'tahun' => $tahun,
    //     //         'categories' => json_encode($dataDaerah),
    //     //         'carbonSeries' => json_encode($carbonValues),
    //     //         'absorptionSeries' => json_encode($absorptionValues),
    //     //     ]);
    // }
}
