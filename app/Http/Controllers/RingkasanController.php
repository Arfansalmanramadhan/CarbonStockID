<?php

namespace App\Http\Controllers;

use App\Models\Necromass;
use App\Models\Pohon;
use App\Models\Tiang;
use App\Models\Pancang;
use App\Models\Semai;
use App\Models\Serasah;
use App\Models\Tanah;
use App\Models\TumbuhanBawah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\PoltArea;
use App\Models\Zona;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class RingkasanController extends Controller
{
    public function index($slug)
    {
        $user = Auth::user();
        $poltArea = PoltArea::where('slug', $slug)->firstOrFail();
        $zona = Zona::where('polt_area_id', $poltArea->id)->get();
        $now = Carbon::now('Asia/Jakarta');
        $formattedDate = $now->format('d M Y H:i:s');
        $ringkasan = $this->ringkasann($slug)->getData()['ringkasan'];
        $ringkasann = $this->ringkasann($slug)->getData()['ringkasann'];
        return view("tambah.ringkasan", compact("user",  'poltArea', 'zona', 'ringkasan', 'ringkasann', 'formattedDate'));
    }
    public function downloadRingkasan($slug)
    {
        $user = Auth::user();
        $poltArea = PoltArea::where('slug', $slug)->firstOrFail();
        $zona = Zona::where('polt_area_id', $poltArea->id)->get();
        $now = Carbon::now('Asia/Jakarta');
        $formattedDate = $now->format('d M Y H:i:s');
        $ringkasan = $this->ringkasann($slug)->getData()['ringkasan'];
        $ringkasann = $this->ringkasann($slug)->getData()['ringkasann'];

        // Load view untuk PDF
        // $pdf = PDF::loadView('tambah.ringkasan', compact('poltArea', 'ringkasan', 'ringkasann', 'user', 'zona'))
        //     ->setPaper('a4', 'portrait');
        $pdf = PDF::loadView('tambah.ringkasan', [
            'poltArea' => $poltArea,
            'ringkasan' => $ringkasan,
            'ringkasann' => $ringkasann,
            'user' => $user,
            'formattedDate' => $formattedDate,
            'pdf' => true // Tambahkan ini
        ])->setPaper('portrait')
            ->set_option('isHtml5ParserEnabled', true);


        // Unduh PDF
        return $pdf->download('ringkasan-' . $slug . '.pdf');
    }
    public function ringkasann($slug)
    {
        $poltArea = PoltArea::where('slug', $slug)->firstOrFail();
        $ringkasan = Zona::where('polt_area_id', $poltArea->id)
            ->leftJoin('polt_area', 'zona.polt_area_id', '=', 'polt_area.id')
            ->leftJoin('hamparan', 'hamparan.zona_id', '=', 'zona.id') // Hamparan ke Zona
            ->leftJoin('plot', 'plot.hamparan_id', '=', 'hamparan.id') // Plot ke Hamparan
            ->leftJoin('subplot', 'subplot.plot_id', '=', 'plot.id') // Subplot ke Plot

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
            ->select(
                'zona.id as zona_id',
                'zona.zona as zona_nama',
                'zona.polt_area_id',
                'polt_area.luas_lokasi',
                // Pancang
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
                DB::raw('SUM(tanah.carbonkg) as total_carbon_tanah'),
                DB::raw('SUM(tanah.co2kg) as total_co2_tanah')
            )
            // ->where('slug',$slug)
            ->groupBy('zona.id', 'zona.zona', 'zona.polt_area_id', 'polt_area.luas_lokasi')
            ->get()
            ->map(fn($item) => (object) $item);
        // Lakukan perhitungan tambahan untuk masing-masing zona
        $ringkasan = $ringkasan->map(function ($zona) {
            $faktor =   $zona->luas_lokasi ?? 11.5;
            // $faktor =  max((float) $zona->luas_lokasi, 11.5);
            // Perhitungan Pancang
            $zonaid = $zona->polt_area_id;
            // dd($zona->zona_nama);
            $tanahh = DB::table('tanah')
                ->leftJoin('subplot', 'tanah.subplot_id', '=', 'subplot.id')
                ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
                ->leftJoin('zona', 'hamparan.zona_id', '=', 'zona.id')
                ->where('zona.id', '=', $zona->zona_id)
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
                ->where('zona.id', '=', $zona->zona_id)
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
                ->where('zona.id', '=', $zona->zona_id)
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
                ->where('zona.id', '=', $zona->zona_id)
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
                ->where('zona.id', '=', $zona->zona_id)
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
                ->where('zona.id', '=', $zona->zona_id)
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
                ->where('zona.id', '=', $zona->zona_id)
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
                ->where('zona.id', '=', $zona->zona_id)
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

            // dd($serasahBeratKering);

            // dd($zonaa);
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
            $hasilSerasahPersen     = ($TotalKarbon5POL != 0) ? ($Serasa / $TotalKarbon5POL) * 100 : 0;
            $hasilNecromassPersen   = ($TotalKarbon5POL != 0) ? ($Necromass / $TotalKarbon5POL) * 100 : 0;
            $hasilco2tanamanPersen  = ($TotalKarbon5POL != 0) ? ($co2tanaman / $TotalKarbon5POL) * 100 : 0;
            $hasilakarPersen        = ($TotalKarbon5POL != 0) ? ($akar / $TotalKarbon5POL) * 100 : 0;
            $hasiltanahPersen       = ($TotalKarbon5POL != 0) ? ($tanah / $TotalKarbon5POL) * 100 : 0;
            return [
                'zona' => $zona->zona_nama,
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
            ];
            // dd($zon  a, $TotalPancangco2, $TotalPancangkarbon, $TotalMangroveKarbondioksida);
        });
        $ringkasan = $ringkasan->toArray();
        // dd($ringkasan);
        // dd( $ringkasan);
        $ringkasann = Zona::where('polt_area_id', $poltArea->id)
            ->leftJoin('polt_area', 'zona.polt_area_id', '=', 'polt_area.id')
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
            ->select(
                'polt_area.id as polt_area_id',
                'polt_area.luas_lokasi',
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
                DB::raw('SUM(tanah.carbonkg) as total_carbon_tanah'),
                DB::raw('SUM(tanah.co2kg) as total_co2_tanah')
            )
            // ->where('slug',$slug)
            ->groupBy('polt_area.id', 'polt_area.luas_lokasi')
            ->get()
            ->map(fn($item) => (object) $item);
        // Lakukan perhitungan tambahan untuk masing-masing zona
        $ringkasann = $ringkasann->map(function ($zona) {
            $faktor =   $zona->luas_lokasi ?? 11.5;
            // $faktor =  max((float) $zona->luas_lokasi, 11.5);
            // Perhitungan Pancang
            $zonaid = $zona->polt_area_id;
            // dd($zona->zona_nama);
            $tanahh = DB::table('tanah')
                ->leftJoin('subplot', 'tanah.subplot_id', '=', 'subplot.id')
                ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
                ->leftJoin('zona', 'hamparan.zona_id', '=', 'zona.id')
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

            // dd($serasahBeratKering);

            // dd($zonaa);
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
            // Total Karbon
            $TotalKarbon5POL = $Serasa + $Necromass + $co2tanaman + $tanah + $akar;
            // Perhitungan Baseline Lahan Kosong
            $BaselineLahanKosong = $TotalKarbon5POL - (((10 + 4) / 2) * $faktor);
            // persen
            $hasilSerasahPersen     = ($TotalKarbon5POL != 0) ? ($Serasa / $TotalKarbon5POL) * 100 : 0;
            $hasilNecromassPersen   = ($TotalKarbon5POL != 0) ? ($Necromass / $TotalKarbon5POL) * 100 : 0;
            $hasilco2tanamanPersen  = ($TotalKarbon5POL != 0) ? ($co2tanaman / $TotalKarbon5POL) * 100 : 0;
            $hasilakarPersen        = ($TotalKarbon5POL != 0) ? ($akar / $TotalKarbon5POL) * 100 : 0;
            $hasiltanahPersen       = ($TotalKarbon5POL != 0) ? ($tanah / $TotalKarbon5POL) * 100 : 0;
            // dd([
            //         'Rata-rata Pancang CO2' => $rataPancangCo2,


            //         'Rata-rata Tiang CO2' => $rataTiangCo2,

            //         'Rata-rata Pohon CO2' => $rataPohonCo2,
            //     ]);
            return [
                // 'zona' => $zona->zona_nama,
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
            ];
            // dd($zon  a, $TotalPancangco2, $TotalPancangkarbon, $TotalMangroveKarbondioksida);
        });
        $ringkasann = $ringkasann->toArray();
        // dd($ringkasann);
        // dd( $ringkasan);

        return view('tambah.ringkasan', compact('ringkasan', 'poltArea', 'ringkasann'),);
    }
}
