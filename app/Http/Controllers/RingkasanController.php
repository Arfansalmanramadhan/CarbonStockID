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
            $zonaData = DB::table('zona')
                ->leftJoin('hamparan', 'hamparan.zona_id', '=', 'zona.id')
                ->leftJoin('plot', 'plot.hamparan_id', '=', 'hamparan.id')
                ->leftJoin('subplot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('pancang', 'pancang.subplot_id', '=', 'subplot.id')
                ->leftJoin('tiang', 'tiang.subplot_id', '=', 'subplot.id')
                ->leftJoin('pohon', 'pohon.subplot_id', '=', 'subplot.id')
                ->leftJoin('serasah', 'serasah.subplot_id', '=', 'subplot.id')
                ->leftJoin('semai', 'semai.subplot_id', '=', 'subplot.id')
                ->leftJoin('necromass', 'necromass.subplot_id', '=', 'subplot.id')
                ->leftJoin('tanah', 'tanah.subplot_id', '=', 'subplot.id')
                ->leftJoin('tumbuhan_bawah', 'tumbuhan_bawah.subplot_id', '=', 'subplot.id')
                ->leftJoin('mangrove', 'mangrove.subplot_id', '=', 'subplot.id')
                ->where('zona.id', '=', $zona->zona_id)
                ->groupBy('zona.id') // Pastikan grouping dilakukan per zona
                ->select(
                    'zona.id as zona_id',
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
                    DB::raw('SUM(tanah.co2kg) as total_co2_tanah'),
                )
                ->get();
            //    dd( $zonaData);
            // Perhitungan Pancang

            $totalZona = count($zonaData); // Jumlah total zona yang dihitung
            // dd($zona);
            // Inisialisasi total keseluruhan
            $totalPancangCo2Keseluruhan = 0;
            $totalPancangKarbonKeseluruhan = 0;
            $totalPancangBiomassaKeseluruhan = 0;

            $totalMangroveCo2Keseluruhan = 0;
            $totalMangroveKarbonKeseluruhan = 0;
            $totalMangroveBiomassaKeseluruhan = 0;

            $totalTiangCo2Keseluruhan = 0;
            $totalTiangKarbonKeseluruhan = 0;
            $totalTiangBiomassaKeseluruhan = 0;

            $totalPohonCo2Keseluruhan = 0;
            $totalPohonKarbonKeseluruhan = 0;
            $totalPohonBiomassaKeseluruhan = 0;

            foreach ($zonaData as $zonaa) {
                $constantPancang = 25;
                $TotalPancangco2 = ($zonaa->pancang_avg_co2 * ($zonaa->total_pohon_pancang / $constantPancang) * 10000) / 1000;
                $TotalPancangkarbon = ($zonaa->pancang_avg_kandungan_karbon * ($zonaa->total_pohon_pancang / $constantPancang) * 10000) / 1000;
                $TotalPancangbiomassa = ($zonaa->pancang_avg_bio_di_atas_tanah * ($zonaa->total_pohon_pancang / $constantPancang) * 10000) / 1000;

                $constantMangrove = 25;
                $TotalMangroveCo2 = ($zonaa->mangrove_avg_karbondioksida * ($zonaa->total_mangrove / $constantMangrove) * 10000) / 1000;
                $TotalMangrovekarbon = ($zonaa->mangrove_avg_kandungan_karbon * ($zonaa->total_mangrove / $constantMangrove) * 10000) / 1000;
                $TotalMangrovebiomassa = ($zonaa->mangrove_avg_biomasa * ($zonaa->total_mangrove / $constantMangrove) * 10000) / 1000;

                $constantTiang = 100;
                $TotalTiangCo2 = ($zonaa->tiang_avg_co2 * ($zonaa->total_tiang / $constantTiang) * 10000) / 1000;
                $TotalTiangKarbon = ($zonaa->tiang_avg_kandungan_karbon * ($zonaa->total_tiang / $constantTiang) * 10000) / 1000;
                $TotalTiangBiomassa = ($zonaa->tiang_avg_bio_di_atas_tanah * ($zonaa->total_tiang / $constantTiang) * 10000) / 1000;

                $constantPohon = 400;
                $TotalPohonCo2 = ($zonaa->pohon_avg_co2 * ($zonaa->total_pohon / $constantPohon) * 10000) / 1000;
                $TotalPohonKarbon = ($zonaa->pohon_avg_kandungan_karbon * ($zonaa->total_pohon / $constantPohon) * 10000) / 1000;
                $TotalPohonBiomassa = ($zonaa->pohon_avg_bio_di_atas_tanah * ($zonaa->total_pohon / $constantPohon) * 10000) / 1000;

                // Tambahkan ke total keseluruhan
                $totalPancangCo2Keseluruhan += $TotalPancangco2;
                $totalPancangKarbonKeseluruhan += $TotalPancangkarbon;
                $totalPancangBiomassaKeseluruhan += $TotalPancangbiomassa;

                $totalMangroveCo2Keseluruhan += $TotalMangroveCo2;
                $totalMangroveKarbonKeseluruhan += $TotalMangrovekarbon;
                $totalMangroveBiomassaKeseluruhan += $TotalMangrovebiomassa;

                $totalTiangCo2Keseluruhan += $TotalTiangCo2;
                $totalTiangKarbonKeseluruhan += $TotalTiangKarbon;
                $totalTiangBiomassaKeseluruhan += $TotalTiangBiomassa;

                $totalPohonCo2Keseluruhan += $TotalPohonCo2;
                $totalPohonKarbonKeseluruhan += $TotalPohonKarbon;
                $totalPohonBiomassaKeseluruhan += $TotalPohonBiomassa;
            }

            // Hitung rata-rata
            $rataPancangCo22 = $totalZona ? $totalPancangCo2Keseluruhan / $totalZona : 0;
            $rataPancangKarbonn = $totalZona ? $totalPancangKarbonKeseluruhan / $totalZona : 0;
            $rataPancangBiomassas = $totalZona ? $totalPancangBiomassaKeseluruhan / $totalZona : 0;

            $rataMangroveCo2 = $totalZona ? $totalMangroveCo2Keseluruhan / $totalZona : 0;
            $rataMangroveKarbon = $totalZona ? $totalMangroveKarbonKeseluruhan / $totalZona : 0;
            $rataMangroveBiomassa = $totalZona ? $totalMangroveBiomassaKeseluruhan / $totalZona : 0;

            $rataTiangCo22 = $totalZona ? $totalTiangCo2Keseluruhan / $totalZona : 0;
            $rataTiangKarbonn = $totalZona ? $totalTiangKarbonKeseluruhan / $totalZona : 0;
            $rataTiangBiomassaa = $totalZona ? $totalTiangBiomassaKeseluruhan / $totalZona : 0;

            $rataPohonCo22 = $totalZona ? $totalPohonCo2Keseluruhan / $totalZona : 0;
            $rataPohonKarbonn = $totalZona ? $totalPohonKarbonKeseluruhan / $totalZona : 0;
            $rataPohonBiomassaa = $totalZona ? $totalPohonBiomassaKeseluruhan / $totalZona : 0;
            $rataPancangCo2 =  $faktor * $rataPancangCo22;
            $rataPancangKarbon = $faktor * $rataPancangKarbonn;
            $rataPancangBiomassa = $faktor * $rataPancangBiomassas;

            $rataMangroveCo2 = $totalZona ? $totalMangroveCo2Keseluruhan / $totalZona : 0;
            $rataMangroveKarbon = $totalZona ? $totalMangroveKarbonKeseluruhan / $totalZona : 0;
            $rataMangroveBiomassa = $totalZona ? $totalMangroveBiomassaKeseluruhan / $totalZona : 0;

            $rataTiangCo2 = $faktor * $rataTiangCo22;
            $rataTiangKarbon = $faktor * $rataTiangKarbonn;
            $rataTiangBiomassa = $faktor * $rataTiangBiomassaa;

            $rataPohonCo2 = $faktor * $rataPohonCo22;
            $rataPohonKarbon = $faktor * $rataPohonKarbonn;
            $rataPohonBiomassa = $faktor * $rataPohonBiomassaa;
            // dd([
            //     'Rata-rata Pancang CO2' => $rataPancangCo2,
            //     'Rata-rata Pancang Karbon' => $rataPancangKarbon,
            //     'Rata-rata Pancang Biomassa' => $rataPancangBiomassa,

            //     'Rata-rata Mangrove CO2' => $rataMangroveCo2,
            //     'Rata-rata Mangrove Karbon' => $rataMangroveKarbon,
            //     'Rata-rata Mangrove Biomassa' => $rataMangroveBiomassa,

            //     'Rata-rata Tiang CO2' => $rataTiangCo2,
            //     'Rata-rata Tiang Karbon' => $rataTiangKarbon,
            //     'Rata-rata Tiang Biomassa' => $rataTiangBiomassa,

            //     'Rata-rata Pohon CO2' => $rataPohonCo2,
            //     'Rata-rata Pohon Karbon' => $rataPohonKarbon,
            //     'Rata-rata Pohon Biomassa' => $rataPohonBiomassa,
            // ]);

            // Perhitungan CO2 dari Serasah (dibagi berdasarkan jumlah nilai unik)
            $uniqueCounts = DB::table('zona')
                ->leftJoin('hamparan', 'hamparan.zona_id', '=', 'zona.id')
                ->leftJoin('plot', 'plot.hamparan_id', '=', 'hamparan.id')
                ->leftJoin('subplot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('serasah', 'serasah.subplot_id', '=', 'subplot.id')
                ->leftJoin('semai', 'semai.subplot_id', '=', 'subplot.id')
                ->leftJoin('tumbuhan_bawah', 'tumbuhan_bawah.subplot_id', '=', 'subplot.id')
                ->leftJoin('necromass', 'necromass.subplot_id', '=', 'subplot.id')
                ->where('zona.id', '=', $zona->zona_id)
                // ->whereNotNull('zona.zona') // Pastikan zona tidak NULL
                ->where('zona.zona', '!=', '')
                ->select(
                    DB::raw('COUNT(DISTINCT TRIM(zona.zona)) as total_zona'),
                    DB::raw('SUM(serasah.co2) as serasah_co2'),
                    DB::raw('SUM(serasah.kandungan_karbon) as serasah_kandungan_karbon'),
                    DB::raw('SUM(serasah.total_berat_kering) as serasah_total_berat_kering'),

                    DB::raw('SUM(semai.co2) as semai_co2'),
                    DB::raw('SUM(semai.kandungan_karbon) as semai_kandungan_karbon'),
                    DB::raw('SUM(semai.total_berat_kering) as semai_total_berat_kering'),

                    DB::raw('SUM(tumbuhan_bawah.co2) as tumbuhan_bawah_co2'),
                    DB::raw('SUM(tumbuhan_bawah.kandungan_karbon) as tumbuhan_bawah_kandungan_karbon'),
                    DB::raw('SUM(tumbuhan_bawah.total_berat_kering) as tumbuhan_bawah_total_berat_kering'),

                    DB::raw('SUM(necromass.co2) as necromass_co2'),
                    DB::raw('SUM(necromass.biomasa) as necromass_total_biomasa'),
                    DB::raw('SUM(necromass.carbon) as necromass_total_carbon')
                )
                ->first();

            $totalZona = $uniqueCounts->total_zona;

            $hasilSerasahCo2 = $uniqueCounts->serasah_co2 / $totalZona;;
            $Serasahco2 = ($hasilSerasahCo2 / 1000000) * 10000;
            // dd($hasilSerasahCo2);
            $hasilSerasahKarbon = $uniqueCounts->serasah_kandungan_karbon / $totalZona;;
            $SerasahKarbon = ($hasilSerasahKarbon / 1000000) * 10000;

            $hasilSerasahberatkering = $uniqueCounts->serasah_total_berat_kering / $totalZona;

            $Serasahberatkering = ($hasilSerasahberatkering / 1000000) * 10000;
            // semai


            $hasilsemaiCo2 = $uniqueCounts->semai_co2 / $totalZona;

            $semaico2 = ($hasilsemaiCo2 / 1000000) * 10000;
            // dd($uniqueCounts, $hasilsemaiCo2);
            $hasilsemaiKarbon = $uniqueCounts->semai_kandungan_karbon / $totalZona;

            $semaiKarbon = ($hasilsemaiKarbon / 1000000) * 10000;
            // dd($uniqueCounts, $hasilsemaiKarbon);
            $hasilsemaiberatkering = $uniqueCounts->semai_total_berat_kering / $totalZona;

            $semaiberatkering = ($hasilsemaiberatkering / 1000000) * 10000;
            // tumbuhan bah
            $hasiltumbuhan_bawahCo2 = $uniqueCounts->tumbuhan_bawah_co2 / $totalZona;

            $tumbuhan_bawahco2 = ($hasiltumbuhan_bawahCo2 / 1000000) * 10000;

            $hasiltumbuhan_bawahKarbon = $uniqueCounts->tumbuhan_bawah_kandungan_karbon / $totalZona;

            $tumbuhan_bawahKarbon = ($hasiltumbuhan_bawahKarbon / 1000000) * 10000;

            $hasiltumbuhan_bawahberatkering = $uniqueCounts->tumbuhan_bawah_total_berat_kering / $totalZona;

            $tumbuhan_bawahberatkering = ($hasiltumbuhan_bawahberatkering / 1000000) * 10000;


            // Konversi nilai Necromass

            $hasilNecromashCo2 = $uniqueCounts->necromass_co2 / $totalZona;

            $Necromassco2 = ($hasilNecromashCo2 / 1000000) * 10000 / 400;

            $hasilNecromasbiomasa = $uniqueCounts->necromass_total_biomasa / $totalZona;

            $Necromassbiomasa = ($hasilNecromasbiomasa / 1000000) * 10000 / 400;

            $hasilNecromascarbon = $uniqueCounts->necromass_total_carbon / $totalZona;

            $NecromassCarbon = ($hasilNecromascarbon / 1000000) * 10000 / 400;

            // dd($serasahBeratKering);

            // dd($zonaa);
            // klandungan karbon
            $Biomassadiataspermukaantanah = $rataPancangBiomassa +  $rataTiangBiomassa + $rataPohonBiomassa + $Serasahberatkering +  $semaiberatkering +  $tumbuhan_bawahberatkering +   $Necromassbiomasa;
            $Kandungankarbon = $rataPancangKarbon +  $rataTiangKarbon + $rataPohonKarbon + $SerasahKarbon +  $semaiKarbon + $tumbuhan_bawahKarbon + $NecromassCarbon;
            $SerapanCO2  = $rataPancangCo2 + $rataTiangCo2 +   $rataPohonCo2 +  $Serasahco2 +  $semaico2 +  $tumbuhan_bawahco2 +  $Necromassco2;
            // TootaL Karbon
            $TotalKandunganKarbon =  $zona->total_carbon_tanah + $hasilNecromascarbon + $SerasahKarbon + $semaiKarbon  + $tumbuhan_bawahKarbon + $rataPohonKarbon + $rataPancangKarbon + $rataTiangKarbon;
            // Total carbon tanama kandungan karbon
            $TotalCarbon =  $semaico2   + $rataPohonCo2 + $rataPancangCo2 + $rataTiangCo2 + $tumbuhan_bawahco2;
            // serapan co2
            // Total berat biomassa tanaman/ AKAR
            $totalBerat = $rataPancangCo2 + $rataTiangCo2 + $rataPohonCo2;
            $beratMasaAkar = $totalBerat * 0.37;
            // total karbon ]
            $KarbonCo2 = $rataPancangCo2 + $beratMasaAkar + $rataTiangCo2 + $rataPohonCo2  + $Serasahco2 + $semaico2 + $tumbuhan_bawahco2 + $hasilNecromashCo2;
            // Pendekatan Kerapatan

            // Total CO2 dari tanaman
            $Co2Tanamannn = $rataPancangCo2 + $rataTiangCo2 + $rataPohonCo2;
            $totalCo2Lokasi = $Co2Tanamannn * $faktor;

            // Faktor konversi CO2
            $Serasa = $Serasahco2 * $faktor;
            $Necromass = $Necromassco2 * $faktor;
            $co2tanaman = $Co2Tanamannn * $faktor;
            $akar = $beratMasaAkar * 1.00; // Asumsi biomassa akar tanpa perubahan
            $tanah = $zona->total_co2_tanah * 1.00;
            $tanah = $zona->total_co2_tanah * 1.00;
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
                'Biomassadiataspermukaantanah' => number_format($Biomassadiataspermukaantanah ?? 0, 3, '.', ''),
                'Kandungankarbon' => number_format($Kandungankarbon ?? 0, 3, '.', ''),
                'SerapanCO2' => number_format($SerapanCO2 ?? 0, 3, '.', ''),
                'TotalPancangco2' => number_format($rataPancangCo2 ?? 0, 3, '.', ''),
                'TotalPancangkarbon' => number_format($rataPancangKarbon ?? 0, 3, '.', ''),
                'TotalMangroveKarbondioksida' => number_format($TotalMangroveKarbondioksida ?? 0, 3, '.', ''),
                'TotalMangrovekarbon' => number_format($TotalMangrovekarbon ?? 0, 3, '.', ''),
                'TotalTiangco2' => number_format($rataTiangCo2 ?? 0, 3, '.', ''),
                'TotalTiangKarbon' => number_format($rataTiangKarbon ?? 0, 3, '.', ''),
                'TotalPohonco2' => number_format($rataPohonCo2 ?? 0, 3, '.', ''),
                'TotalPohonkarbon' => number_format($rataPohonKarbon ?? 0, 3, '.', ''),
                'Serasahco2' => number_format($Serasahco2 ?? 0, 3, '.', ''),
                'SerasahKarbon' => number_format($SerasahKarbon ?? 0, 3, '.', ''),
                'semaico2' => number_format($semaico2 ?? 0, 3, '.', ''),
                'semaiKarbon' => number_format($semaiKarbon ?? 0, 3, '.', ''),
                'tumbuhanbawahco2' => number_format($tumbuhan_bawahco2 ?? 0, 3, '.', ''),
                'tumbuhanbawahkarbon' => number_format($tumbuhan_bawahKarbon ?? 0, 3, '.', ''),
                'Necromassco2' => number_format($hasilNecromashCo2 ?? 0, 3, '.', ''),
                'NecromassCarbon' => number_format($hasilNecromascarbon ?? 0, 3, '.', ''),
                'TotalKandunganKarbon' => number_format($TotalKandunganKarbon ?? 0, 3, '.', ''),
                'KarbonCo2' => number_format($KarbonCo2 ?? 0, 3, '.', ''),
                'TotalCarbonn' => number_format($TotalCarbon ?? 0, 3, '.', ''),
                'Serasah' => number_format($Serasa ?? 0, 3, '.', ''),
                'Necromass' => number_format($Necromass ?? 0, 3, '.', ''),
                'Co2Tanaman' => number_format($co2tanaman ?? 0, 3, '.', ''),
                'TanahCo2' => number_format($zona->total_co2_tanah ?? 0, 3, '.', ''),
                'TanahCarbon' => number_format($zona->total_carbon_tanah ?? 0, 3, '.', ''),
                'BeratBiomassaAkar' => number_format($akar ?? 0, 3, '.', ''),
                'tanah' => number_format($tanah ?? 0, 3, '.', ''),
                'beratMasaAkar' => number_format($beratMasaAkar ?? 0, 3, '.', ''),
                'faktor' => number_format($faktor ?? 0, 0, '.', ''),
                'TotalKaoobon' => number_format($TotalKarbon5POL ?? 0, 3, '.', ''),
                'BaselineLahanKosong' => number_format($BaselineLahanKosong ?? 0, 2, '.', ''),
                'hasilSerasahPersen' => number_format($hasilSerasahPersen ?? 0, 2, '.', ''),
                'hasilNecromassPersen' => number_format($hasilNecromassPersen ?? 0, 2, '.', ''),
                'hasilco2tanamanPersen' => number_format($hasilco2tanamanPersen ?? 0, 2, '.', ''),
                'hasilakarPersen' => number_format($hasilakarPersen ?? 0, 2, '.', ''),
                'hasiltanahPersen' => number_format($hasiltanahPersen ?? 0, 2, '.', ''),
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
            $zonaData = DB::table('zona')
                ->leftJoin('hamparan', 'hamparan.zona_id', '=', 'zona.id')
                ->leftJoin('plot', 'plot.hamparan_id', '=', 'hamparan.id')
                ->leftJoin('subplot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('pancang', 'pancang.subplot_id', '=', 'subplot.id')
                ->leftJoin('tiang', 'tiang.subplot_id', '=', 'subplot.id')
                ->leftJoin('pohon', 'pohon.subplot_id', '=', 'subplot.id')
                ->leftJoin('serasah', 'serasah.subplot_id', '=', 'subplot.id')
                ->leftJoin('semai', 'semai.subplot_id', '=', 'subplot.id')
                ->leftJoin('necromass', 'necromass.subplot_id', '=', 'subplot.id')
                ->leftJoin('tanah', 'tanah.subplot_id', '=', 'subplot.id')
                ->leftJoin('tumbuhan_bawah', 'tumbuhan_bawah.subplot_id', '=', 'subplot.id')
                ->leftJoin('mangrove', 'mangrove.subplot_id', '=', 'subplot.id')
                ->where('zona.polt_area_id', $zonaid)
                ->groupBy('zona.zona')
                ->select(
                    'zona.zona',
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
                    DB::raw('SUM(tanah.co2kg) as total_co2_tanah'),
                )
                ->get();
            //    dd( $zonaData);
            // Perhitungan Pancang

            $totalZona = count($zonaData); // Jumlah total zona yang dihitung
            // $totalZonaa = $zonaData->total_zona;
            // dd($totalZona);
            // Inisialisasi total keseluruhan
            $totalPancangCo2Keseluruhan = 0;
            $totalPancangKarbonKeseluruhan = 0;
            $totalPancangBiomassaKeseluruhan = 0;

            $totalMangroveCo2Keseluruhan = 0;
            $totalMangroveKarbonKeseluruhan = 0;
            $totalMangroveBiomassaKeseluruhan = 0;

            $totalTiangCo2Keseluruhan = 0;
            $totalTiangKarbonKeseluruhan = 0;
            $totalTiangBiomassaKeseluruhan = 0;

            $totalPohonCo2Keseluruhan = 0;
            $totalPohonKarbonKeseluruhan = 0;
            $totalPohonBiomassaKeseluruhan = 0;

            foreach ($zonaData as $zonaa) {
                $constantPancang = 25;
                $TotalPancangco2 = ($zonaa->pancang_avg_co2 * ($zonaa->total_pohon_pancang / $constantPancang) * 10000) / 1000;
                $TotalPancangkarbon = ($zonaa->pancang_avg_kandungan_karbon * ($zonaa->total_pohon_pancang / $constantPancang) * 10000) / 1000;
                $TotalPancangbiomassa = ($zonaa->pancang_avg_bio_di_atas_tanah * ($zonaa->total_pohon_pancang / $constantPancang) * 10000) / 1000;

                $constantMangrove = 25;
                $TotalMangroveCo2 = ($zonaa->mangrove_avg_karbondioksida * ($zonaa->total_mangrove / $constantMangrove) * 10000) / 1000;
                $TotalMangrovekarbon = ($zonaa->mangrove_avg_kandungan_karbon * ($zonaa->total_mangrove / $constantMangrove) * 10000) / 1000;
                $TotalMangrovebiomassa = ($zonaa->mangrove_avg_biomasa * ($zonaa->total_mangrove / $constantMangrove) * 10000) / 1000;

                $constantTiang = 100;
                $TotalTiangCo2 = ($zonaa->tiang_avg_co2 * ($zonaa->total_tiang / $constantTiang) * 10000) / 1000;
                $TotalTiangKarbon = ($zonaa->tiang_avg_kandungan_karbon * ($zonaa->total_tiang / $constantTiang) * 10000) / 1000;
                $TotalTiangBiomassa = ($zonaa->tiang_avg_bio_di_atas_tanah * ($zonaa->total_tiang / $constantTiang) * 10000) / 1000;

                $constantPohon = 400;
                $TotalPohonCo2 = ($zonaa->pohon_avg_co2 * ($zonaa->total_pohon / $constantPohon) * 10000) / 1000;
                $TotalPohonKarbon = ($zonaa->pohon_avg_kandungan_karbon * ($zonaa->total_pohon / $constantPohon) * 10000) / 1000;
                $TotalPohonBiomassa = ($zonaa->pohon_avg_bio_di_atas_tanah * ($zonaa->total_pohon / $constantPohon) * 10000) / 1000;
                // Tambahkan ke total keseluruhan
                $totalPancangCo2Keseluruhan += $TotalPancangco2;

                $totalPancangKarbonKeseluruhan += $TotalPancangkarbon;
                $totalPancangBiomassaKeseluruhan += $TotalPancangbiomassa;

                $totalMangroveCo2Keseluruhan += $TotalMangroveCo2;
                $totalMangroveKarbonKeseluruhan += $TotalMangrovekarbon;
                $totalMangroveBiomassaKeseluruhan += $TotalMangrovebiomassa;

                $totalTiangCo2Keseluruhan += $TotalTiangCo2;
                $totalTiangKarbonKeseluruhan += $TotalTiangKarbon;
                $totalTiangBiomassaKeseluruhan += $TotalTiangBiomassa;

                $totalPohonCo2Keseluruhan += $TotalPohonCo2;
                $totalPohonKarbonKeseluruhan += $TotalPohonKarbon;
                $totalPohonBiomassaKeseluruhan += $TotalPohonBiomassa;
            }
            // dd($totalPancangCo2Keseluruhan);
            // dd($totalPancangCo2Keseluruhan, $TotalPancangco2);
            // Hitung rata-rata
            $rataPancangCo22 = $totalZona ? $totalPancangCo2Keseluruhan / $totalZona : 0;
            $rataPancangKarbonn = $totalZona ? $totalPancangKarbonKeseluruhan / $totalZona : 0;
            $rataPancangBiomassas = $totalZona ? $totalPancangBiomassaKeseluruhan / $totalZona : 0;

            $rataMangroveCo2 = $totalZona ? $totalMangroveCo2Keseluruhan / $totalZona : 0;
            $rataMangroveKarbon = $totalZona ? $totalMangroveKarbonKeseluruhan / $totalZona : 0;
            $rataMangroveBiomassa = $totalZona ? $totalMangroveBiomassaKeseluruhan / $totalZona : 0;

            $rataTiangCo22 = $totalZona ? $totalTiangCo2Keseluruhan / $totalZona : 0;
            $rataTiangKarbonn = $totalZona ? $totalTiangKarbonKeseluruhan / $totalZona : 0;
            $rataTiangBiomassaa = $totalZona ? $totalTiangBiomassaKeseluruhan / $totalZona : 0;

            $rataPohonCo22 = $totalZona ? $totalPohonCo2Keseluruhan / $totalZona : 0;
            $rataPohonKarbonn = $totalZona ? $totalPohonKarbonKeseluruhan / $totalZona : 0;
            $rataPohonBiomassaa = $totalZona ? $totalPohonBiomassaKeseluruhan / $totalZona : 0;
            $rataPancangCo2 =  $faktor * $rataPancangCo22;
            $rataPancangKarbon = $faktor * $rataPancangKarbonn;
            $rataPancangBiomassa = $faktor * $rataPancangBiomassas;

            $rataMangroveCo2 = $totalZona ? $totalMangroveCo2Keseluruhan / $totalZona : 0;
            $rataMangroveKarbon = $totalZona ? $totalMangroveKarbonKeseluruhan / $totalZona : 0;
            $rataMangroveBiomassa = $totalZona ? $totalMangroveBiomassaKeseluruhan / $totalZona : 0;

            $rataTiangCo2 = $faktor * $rataTiangCo22;
            $rataTiangKarbon = $faktor * $rataTiangKarbonn;
            $rataTiangBiomassa = $faktor * $rataTiangBiomassaa;

            $rataPohonCo2 = $faktor * $rataPohonCo22;
            $rataPohonKarbon = $faktor * $rataPohonKarbonn;
            $rataPohonBiomassa = $faktor * $rataPohonBiomassaa;
            //    dd($totalPancangCo2Keseluruhan, $totalTiangCo2Keseluruhan, $totalPohonCo2Keseluruhan);
            // Tampilkan hasil
            // dd([
            //     'Rata-rata Pancang CO2' => $rataPancangCo2,
            //     'Rata-rata Pancang Karbon' => $rataPancangKarbon,
            //     'Rata-rata Pancang Biomassa' => $rataPancangBiomassa,

            //     'Rata-rata Mangrove CO2' => $rataMangroveCo2,
            //     'Rata-rata Mangrove Karbon' => $rataMangroveKarbon,
            //     'Rata-rata Mangrove Biomassa' => $rataMangroveBiomassa,

            //     'Rata-rata Tiang CO2' => $rataTiangCo2,
            //     'Rata-rata Tiang Karbon' => $rataTiangKarbon,
            //     'Rata-rata Tiang Biomassa' => $rataTiangBiomassa,

            //     'Rata-rata Pohon CO2' => $rataPohonCo2,
            //     'Rata-rata Pohon Karbon' => $rataPohonKarbon,
            //     'Rata-rata Pohon Biomassa' => $rataPohonBiomassa,
            // ]);

            // Perhitungan CO2 dari Serasah (dibagi berdasarkan jumlah nilai unik)

            // dd($zona->polt_area_id);

            $uniqueCounts = DB::table('zona')
                ->leftJoin('hamparan', 'hamparan.zona_id', '=', 'zona.id')
                ->leftJoin('plot', 'plot.hamparan_id', '=', 'hamparan.id')
                ->leftJoin('subplot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('serasah', 'serasah.subplot_id', '=', 'subplot.id')
                ->leftJoin('semai', 'semai.subplot_id', '=', 'subplot.id')
                ->leftJoin('tumbuhan_bawah', 'tumbuhan_bawah.subplot_id', '=', 'subplot.id')
                ->leftJoin('necromass', 'necromass.subplot_id', '=', 'subplot.id')
                ->where('zona.polt_area_id', $zonaid)
                // ->whereNotNull('zona.zona') // Pastikan zona tidak NULL
                ->where('zona.zona', '!=', '')
                ->select(
                    DB::raw('COUNT(DISTINCT TRIM(zona.zona)) as total_zona'),
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN serasah.co2 ELSE 0 END) as serasah_co2"),
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN serasah.kandungan_karbon ELSE 0 END) as serasah_kandungan_karbon"),
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN serasah.total_berat_kering ELSE 0 END) as serasah_total_berat_kering"),
                    // Semai
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN semai.co2 ELSE 0 END) as semai_co2"),
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN semai.kandungan_karbon ELSE 0 END) as semai_kandungan_karbon"),
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN semai.total_berat_kering ELSE 0 END) as semai_total_berat_kering"),
                    // Tumbuhan Bawah
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN tumbuhan_bawah.co2 ELSE 0 END) as tumbuhan_bawah_co2"),
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN tumbuhan_bawah.kandungan_karbon ELSE 0 END) as tumbuhan_bawah_kandungan_karbon"),
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN tumbuhan_bawah.total_berat_kering ELSE 0 END) as tumbuhan_bawah_total_berat_kering"),
                    // Necromass
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN necromass.co2 ELSE 0 END) as necromass_co2"),
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN necromass.biomasa ELSE 0 END) as necromass_total_biomasa"),
                    DB::raw("SUM(CASE WHEN plot.status = 'aktif' THEN necromass.carbon ELSE 0 END) as necromass_total_carbon")
                )
                ->first();

            $totalZona = $uniqueCounts->total_zona;

            $hasilSerasahCo2 = $uniqueCounts->serasah_co2 / $totalZona;;
            $Serasahco2 = ($hasilSerasahCo2 / 1000000) * 10000;
            // dd($hasilSerasahCo2);
            $hasilSerasahKarbon = $uniqueCounts->serasah_kandungan_karbon / $totalZona;;
            $SerasahKarbon = ($hasilSerasahKarbon / 1000000) * 10000;

            $hasilSerasahberatkering = $uniqueCounts->serasah_total_berat_kering / $totalZona;

            $Serasahberatkering = ($hasilSerasahberatkering / 1000000) * 10000;
            // dd($hasilSerasahCo2, $hasilSerasahKarbon, $hasilSerasahberatkering );
            // semai


            $hasilsemaiCo2 = $uniqueCounts->semai_co2 / $totalZona;

            $semaico2 = ($hasilsemaiCo2 / 1000000) * 10000;
            // dd($uniqueCounts, $hasilsemaiCo2);
            $hasilsemaiKarbon = $uniqueCounts->semai_kandungan_karbon / $totalZona;

            $semaiKarbon = ($hasilsemaiKarbon / 1000000) * 10000;
            // dd($uniqueCounts, $hasilsemaiKarbon);
            $hasilsemaiberatkering = $uniqueCounts->semai_total_berat_kering / $totalZona;

            $semaiberatkering = ($hasilsemaiberatkering / 1000000) * 10000;
            // tumbuhan bah
            $hasiltumbuhan_bawahCo2 = $uniqueCounts->tumbuhan_bawah_co2 / $totalZona;

            $tumbuhan_bawahco2 = ($hasiltumbuhan_bawahCo2 / 1000000) * 10000;

            $hasiltumbuhan_bawahKarbon = $uniqueCounts->tumbuhan_bawah_kandungan_karbon / $totalZona;

            $tumbuhan_bawahKarbon = ($hasiltumbuhan_bawahKarbon / 1000000) * 10000;

            $hasiltumbuhan_bawahberatkering = $uniqueCounts->tumbuhan_bawah_total_berat_kering / $totalZona;

            $tumbuhan_bawahberatkering = ($hasiltumbuhan_bawahberatkering / 1000000) * 10000;


            // Konversi nilai Necromass

            $hasilNecromashCo2 = $uniqueCounts->necromass_co2 / $totalZona;

            $Necromassco2 = ($hasilNecromashCo2 / 1000000) * 10000 / 400;

            $hasilNecromasbiomasa = $uniqueCounts->necromass_total_biomasa / $totalZona;

            $Necromassbiomasa = ($hasilNecromasbiomasa / 1000000) * 10000 / 400;

            $hasilNecromascarbon = $uniqueCounts->necromass_total_carbon / $totalZona;

            $NecromassCarbon = ($hasilNecromascarbon / 1000000) * 10000 / 400;

            // dd($serasahBeratKering);

            // dd($zonaa);
            // klandungan karbon
            $Biomassadiataspermukaantanah = $rataPancangBiomassa +  $rataTiangBiomassa + $rataPohonBiomassa + $Serasahberatkering +  $semaiberatkering +  $tumbuhan_bawahberatkering +   $Necromassbiomasa;
            $Kandungankarbon = $rataPancangKarbon +  $rataTiangKarbon + $rataPohonKarbon + $SerasahKarbon +  $semaiKarbon + $tumbuhan_bawahKarbon + $NecromassCarbon;
            $SerapanCO2  = $rataPancangCo2 + $rataTiangCo2 +   $rataPohonCo2 +  $Serasahco2 +  $semaico2 +  $tumbuhan_bawahco2 +  $Necromassco2;
            // TootaL Karbon
            $TotalKandunganKarbon =  $zona->total_carbon_tanah + $hasilNecromascarbon + $SerasahKarbon + $semaiKarbon  + $tumbuhan_bawahKarbon + $rataPohonKarbon + $rataPancangKarbon + $rataTiangKarbon;
            // Total carbon tanama kandungan karbon
            $TotalCarbon =  $semaico2   + $rataPohonCo2 + $rataPancangCo2 + $rataTiangCo2 + $tumbuhan_bawahco2;
            // serapan co2
            // Total berat biomassa tanaman/ AKAR
            $totalBerat = $rataPancangCo2 + $rataTiangCo2 + $rataPohonCo2;
            $beratMasaAkar = $totalBerat * 0.37;
            // total karbon ]
            $KarbonCo2 = $rataPancangCo2 + $beratMasaAkar + $rataTiangCo2 + $rataPohonCo2  + $Serasahco2 + $semaico2 + $tumbuhan_bawahco2 + $hasilNecromashCo2;
            // Pendekatan Kerapatan

            // Total CO2 dari tanaman
            $Co2Tanamannn = $rataPancangCo2 + $rataTiangCo2 + $rataPohonCo2;
            $totalCo2Lokasi = $Co2Tanamannn * $faktor;

            // Faktor konversi CO2
            $Serasa = $Serasahco2 * $faktor;
            $Necromass = $Necromassco2 * $faktor;
            $co2tanaman = $Co2Tanamannn * $faktor;
            $akar = $beratMasaAkar * 1.00; // Asumsi biomassa akar tanpa perubahan
            $tanah = $zona->total_co2_tanah * 1.00;
            $tanah = $zona->total_co2_tanah * $faktor;
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
                'Biomassadiataspermukaantanah' => number_format($Biomassadiataspermukaantanah ?? 0, 3, '.', ''),
                'Kandungankarbon' => number_format($Kandungankarbon ?? 0, 3, '.', ''),
                'SerapanCO2' => number_format($SerapanCO2 ?? 0, 3, '.', ''),
                'TotalPancangco2' => number_format($rataPancangCo2 ?? 0, 3, '.', ''),
                'TotalPancangkarbon' => number_format($rataPancangKarbon ?? 0, 3, '.', ''),
                'TotalMangroveKarbondioksida' => number_format($TotalMangroveKarbondioksida ?? 0, 3, '.', ''),
                'TotalMangrovekarbon' => number_format($TotalMangrovekarbon ?? 0, 3, '.', ''),
                'TotalTiangco2' => number_format($rataTiangCo2 ?? 0, 3, '.', ''),
                'TotalTiangKarbon' => number_format($rataTiangKarbon ?? 0, 3, '.', ''),
                'TotalPohonco2' => number_format($rataPohonCo2 ?? 0, 3, '.', ''),
                'TotalPohonkarbon' => number_format($rataPohonKarbon ?? 0, 3, '.', ''),
                'Serasahco2' => number_format($Serasahco2 ?? 0, 3, '.', ''),
                'SerasahKarbon' => number_format($SerasahKarbon ?? 0, 3, '.', ''),
                'semaico2' => number_format($semaico2 ?? 0, 3, '.', ''),
                'semaiKarbon' => number_format($semaiKarbon ?? 0, 3, '.', ''),
                'tumbuhanbawahco2' => number_format($tumbuhan_bawahco2 ?? 0, 3, '.', ''),
                'tumbuhanbawahkarbon' => number_format($tumbuhan_bawahKarbon ?? 0, 3, '.', ''),
                'Necromassco2' => number_format($hasilNecromashCo2 ?? 0, 3, '.', ''),
                'NecromassCarbon' => number_format($hasilNecromascarbon ?? 0, 3, '.', ''),
                'TotalKandunganKarbon' => number_format($TotalKandunganKarbon ?? 0, 3, '.', ''),
                'KarbonCo2' => number_format($KarbonCo2 ?? 0, 3, '.', ''),
                'TotalCarbonn' => number_format($TotalCarbon ?? 0, 3, '.', ''),
                'Serasah' => number_format($Serasa ?? 0, 3, '.', ''),
                'Necromass' => number_format($Necromass ?? 0, 3, '.', ''),
                'Co2Tanaman' => number_format($co2tanaman ?? 0, 3, '.', ''),
                'TanahCo2' => number_format($zona->total_co2_tanah ?? 0, 3, '.', ''),
                'TanahCarbon' => number_format($zona->total_carbon_tanah ?? 0, 3, '.', ''),
                'BeratBiomassaAkar' => number_format($akar ?? 0, 3, '.', ''),
                'tanah' => number_format($tanah ?? 0, 3, '.', ''),
                'beratMasaAkar' => number_format($beratMasaAkar ?? 0, 3, '.', ''),
                'faktor' => number_format($faktor ?? 0, 0, '.', ''),
                'TotalKaoobon' => number_format($TotalKarbon5POL ?? 0, 3, '.', ''),
                'BaselineLahanKosong' => number_format($BaselineLahanKosong ?? 0, 2, '.', ''),
                'hasilSerasahPersen' => number_format($hasilSerasahPersen ?? 0, 2, '.', ''),
                'hasilNecromassPersen' => number_format($hasilNecromassPersen ?? 0, 2, '.', ''),
                'hasilco2tanamanPersen' => number_format($hasilco2tanamanPersen ?? 0, 2, '.', ''),
                'hasilakarPersen' => number_format($hasilakarPersen ?? 0, 2, '.', ''),
                'hasiltanahPersen' => number_format($hasiltanahPersen ?? 0, 2, '.', ''),
            ];
            // dd($zon  a, $TotalPancangco2, $TotalPancangkarbon, $TotalMangroveKarbondioksida);
        });
        $ringkasann = $ringkasann->toArray();
        // dd($ringkasann);
        // dd( $ringkasan);

        return view('tambah.ringkasan', compact('ringkasan', 'poltArea', 'ringkasann'),);
    }
}
