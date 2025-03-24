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
        $formattedDate = Carbon::parse($poltArea->created_at)->format('d M Y');
        $ringkasan = $this->ringkasann($slug)->getData()['ringkasan'];
        $ringkasann = $this->ringkasann($slug)->getData()['ringkasann'];
        return view("tambah.ringkasan", compact("user",  'poltArea', 'zona', 'ringkasan', 'ringkasann', 'formattedDate'));
    }
    public function downloadRingkasan($slug)
    {
        $user = Auth::user();
        $poltArea = PoltArea::where('slug', $slug)->firstOrFail();
        $zona = Zona::where('polt_area_id', $poltArea->id)->get();
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
            'zona' => $zona,
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
            $constantPancang = 25;
            $TotalPancangco2 = ($zona->pancang_avg_co2 * ($zona->total_pohon_pancang / $constantPancang) * 10000) / 1000;
            $TotalPancangkarbon = ($zona->pancang_avg_kandungan_karbon * ($zona->total_pohon_pancang / $constantPancang) * 10000) / 1000;
            $TotalPancangbiomimasa = ($zona->pancang_avg_bio_di_atas_tanah * ($zona->total_pohon_pancang / $constantPancang) * 10000) / 1000;
            // Perhitungan Mangrove
            $constantMangrove = 25;
            $TotalMangroveKarbondioksida = ($zona->mangrove_avg_karbondioksida * ($zona->total_mangrove / $constantMangrove) * 10000) / 1000;
            $TotalMangrovekarbon = ($zona->mangrove_avg_kandungan_karbon * ($zona->total_mangrove / $constantMangrove) * 10000) / 1000;
            $TotalMangrovebiomimasa = ($zona->mangrove_avg_biomasa * ($zona->total_mangrove / $constantMangrove) * 10000) / 1000;

            // Perhitungan Tiang
            $constantTiang = 100;
            $TotalTiangco2 = ($zona->tiang_avg_co2 * ($zona->total_tiang / $constantTiang) * 10000) / 1000;
            $TotalTiangKarbon = ($zona->tiang_avg_kandungan_karbon * ($zona->total_tiang / $constantTiang) * 10000) / 1000;
            $TotalTiangbiomasa = ($zona->tiang_avg_bio_di_atas_tanah * ($zona->total_tiang / $constantTiang) * 10000) / 1000;

            // Perhitungan Pohon
            $constantPohon = 400;
            $TotalPohonco2 = ($zona->pohon_avg_co2 * ($zona->total_pohon / $constantPohon) * 10000) / 1000;
            $TotalPohonkarbon = ($zona->pohon_avg_kandungan_karbon * ($zona->total_pohon / $constantPohon) * 10000) / 1000;
            $TotalPohonbiomasa = ($zona->pohon_avg_bio_di_atas_tanah * ($zona->total_pohon / $constantPohon) * 10000) / 1000;
            // Perhitungan CO2 dari Serasah (dibagi berdasarkan jumlah nilai unik)
            $uniqueSerasah = DB::table('serasah')
                ->leftJoin('subplot', 'serasah.subplot_id', '=', 'subplot.id')
                ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
                ->leftJoin('zona', 'hamparan.zona_id', '=', 'zona.id')
                ->where('zona.id', $zona->zona_id)
                ->distinct()
                ->count(); // Ambil jumlah unik zona_id
            $uniqueSemai = DB::table('semai')
                ->leftJoin('subplot', 'semai.subplot_id', '=', 'subplot.id')
                ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
                ->leftJoin('zona', 'hamparan.zona_id', '=', 'zona.id')
                ->where('zona.id', $zona->zona_id)
                ->distinct()
                ->count();
            $uniqueTumbuhanBawah = DB::table('tumbuhan_bawah')
                ->leftJoin('subplot', 'tumbuhan_bawah.subplot_id', '=', 'subplot.id')
                ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
                ->leftJoin('zona', 'hamparan.zona_id', '=', 'zona.id')
                ->where('zona.id', $zona->zona_id)
                ->distinct()
                ->count();
            $uniqueNecromas = DB::table('necromass')
                ->leftJoin('subplot', 'necromass.subplot_id', '=', 'subplot.id')
                ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
                ->leftJoin('zona', 'hamparan.zona_id', '=', 'zona.id')
                ->where('zona.id', $zona->zona_id)
                ->distinct()
                ->count();

            $zonaa = Zona::where('zona.id', $zona->zona_id)
                ->leftJoin('hamparan', 'hamparan.zona_id', '=', 'zona.id') // Hamparan ke Zona
                ->leftJoin('plot', 'plot.hamparan_id', '=', 'hamparan.id') // Plot ke Hamparan
                ->leftJoin('subplot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('serasah', 'serasah.subplot_id', '=', 'subplot.id')
                ->leftJoin('semai', 'semai.subplot_id', '=', 'subplot.id')
                ->leftJoin('tumbuhan_bawah', 'tumbuhan_bawah.subplot_id', '=', 'subplot.id')
                ->leftJoin('necromass', 'necromass.subplot_id', '=', 'subplot.id')
                ->select(
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
                ->first(); // Ambil satu objek, bukan Collection

            $hasilSerasahCo2 = ($uniqueSerasah > 0) ? ($zonaa->serasah_co2 / $uniqueSerasah) : 0;
            $Serasahco2 = ((float) $hasilSerasahCo2 / 1000000) * 10000;

            $hasilSerasahKarbon = ($uniqueSerasah > 0) ? ($zonaa->serasah_kandungan_karbon / $uniqueSerasah) : 0;
            $SerasahKarbon = ((float) $hasilSerasahKarbon / 1000000) * 10000;

            $hasilSerasahberatkering = ($uniqueSerasah > 0) ? ($zonaa->serasah_total_berat_kering / $uniqueSerasah) : 0;
            $Serasahberatkering = ((float) $hasilSerasahberatkering / 1000000) * 10000;
            // semai
            $hasilsemaiCo2 = ($uniqueSemai > 0) ? ($zonaa->semai_co2 / $uniqueSemai) : 0;
            $semaico2 = ((float) $hasilsemaiCo2 / 1000000) * 10000;

            $hasilsemaiKarbon = ($uniqueSemai > 0) ? ($zonaa->semai_kandungan_karbon / $uniqueSemai) : 0;
            $semaiKarbon = ((float) $hasilsemaiKarbon / 1000000) * 10000;

            $hasilsemaiberatkering = ($uniqueSemai > 0) ? ($zonaa->semai_total_berat_kering / $uniqueSemai) : 0;
            $semaiberatkering = ((float) $hasilsemaiberatkering / 1000000) * 10000;
            // tumbuhan bah
            $hasiltumbuhan_bawahCo2 = ($uniqueTumbuhanBawah > 0) ? ($zonaa->tumbuhan_bawah_co2 / $uniqueTumbuhanBawah) : 0;
            $tumbuhan_bawahco2 = ((float) $hasiltumbuhan_bawahCo2 / 1000000) * 10000;

            $hasiltumbuhan_bawahKarbon = ($uniqueTumbuhanBawah > 0) ? ($zonaa->tumbuhan_bawah_kandungan_karbon / $uniqueTumbuhanBawah) : 0;
            $tumbuhan_bawahKarbon = ((float) $hasiltumbuhan_bawahKarbon / 1000000) * 10000;

            $hasiltumbuhan_bawahberatkering = ($uniqueTumbuhanBawah > 0) ? ($zonaa->tumbuhan_bawah_total_berat_kering / $uniqueTumbuhanBawah) : 0;
            $tumbuhan_bawahberatkering = ((float) $hasiltumbuhan_bawahberatkering / 1000000) * 10000;


            // Konversi nilai Necromass
            $hasilNecromashCo2 = ($uniqueNecromas > 0) ? ($zonaa->necromass_co2 / $uniqueNecromas) : 0;
            $Necromassco2 = ((float) $hasilNecromashCo2 / 1000000) * 10000 / 400;

            $hasilNecromasbiomasa = ($uniqueNecromas > 0) ? ($zonaa->necromass_total_biomasa / $uniqueNecromas) : 0;
            $Necromassbiomasa = ((float) $hasilNecromasbiomasa / 1000000) * 10000 / 400;

            $hasilNecromascarbon = ($uniqueNecromas > 0) ? ($zonaa->necromass_total_carbon / $uniqueNecromas) : 0;
            $NecromassCarbon = ((float) $hasilNecromascarbon / 1000000) * 10000 / 400;
            // klandungan karbon
            $Biomassadiataspermukaantanah = $TotalPancangbiomimasa +  $TotalTiangbiomasa + $TotalPohonbiomasa + $Serasahberatkering +  $semaiberatkering +  $tumbuhan_bawahberatkering +   $Necromassbiomasa;
            $Kandungankarbon = $TotalPancangkarbon +  $TotalTiangKarbon + $TotalPohonkarbon + $SerasahKarbon +  $semaiKarbon + $tumbuhan_bawahKarbon + $NecromassCarbon;
            $SerapanCO2  = $TotalPancangco2 + $TotalTiangco2 +   $TotalPohonco2 +  $Serasahco2 +  $semaico2 +  $tumbuhan_bawahco2 +  $Necromassco2;
            // TootaL Karbon
            $TotalKandunganKarbon =  $zona->total_carbon_tanah + $hasilNecromascarbon + $SerasahKarbon + $semaiKarbon  + $tumbuhan_bawahKarbon + $TotalPohonkarbon + $TotalPancangkarbon + $TotalTiangKarbon;
            // Total carbon tanama kandungan karbon
            $TotalCarbon =  $semaico2   + $TotalPohonco2 + $TotalPancangco2 + $TotalTiangco2 + $tumbuhan_bawahco2;
            // serapan co2
            // Total berat biomassa tanaman/ AKAR
            $totalBerat = $TotalPancangco2 + $TotalTiangco2 + $TotalPohonco2;
            $beratMasaAkar = $totalBerat * 0.37;
            // total karbon ]
            $KarbonCo2 = $TotalPancangco2 + $beratMasaAkar + $TotalTiangco2 + $TotalPohonco2  + $Serasahco2 + $semaico2 + $tumbuhan_bawahco2 + $hasilNecromashCo2;
            // Pendekatan Kerapatan

            // Total CO2 dari tanaman
            $Co2Tanamannn = $TotalPancangco2 + $TotalTiangco2 + $TotalPohonco2;
            $totalCo2Lokasi = $Co2Tanamannn * $faktor;

            // Faktor konversi CO2
            $Serasa = $Serasahco2 * $faktor;
            $Necromass = $Necromassco2 * $faktor;
            $co2tanaman = $Co2Tanamannn * $faktor;
            $akar = $beratMasaAkar * $faktor; // Asumsi biomassa akar tanpa perubahan
            $tanah = $zona->total_co2_tanah * $faktor;
            $tanah = $zona->total_co2_tanah * $faktor;
            // Total Karbon
            $TotalKarbon5POL = $Serasa + $Necromass + $co2tanaman + $tanah + $akar;
            // Perhitungan Baseline Lahan Kosong
            $BaselineLahanKosong = $TotalKarbon5POL - (((10 + 4) / 2) * $faktor);
            // persen
            $hasilSerasahPersen = ($BaselineLahanKosong != 0) ? ($Serasa / $BaselineLahanKosong) * 100 : 0;
            $hasilNecromassPersen = ($BaselineLahanKosong != 0) ? ($Necromass / $BaselineLahanKosong) * 100 : 0;
            $hasilco2tanamanPersen = ($BaselineLahanKosong != 0) ? ($co2tanaman / $BaselineLahanKosong) * 100 : 0;
            $hasilakarPersen = ($BaselineLahanKosong != 0) ? ($akar / $BaselineLahanKosong) * 100 : 0;
            $hasiltanahPersen = ($BaselineLahanKosong != 0) ? ($tanah / $BaselineLahanKosong) * 100 : 0;

            return [
                'zona' => $zona->zona_nama,
                'Biomassadiataspermukaantanah' => number_format($Biomassadiataspermukaantanah ?? 0, 3, '.', ''),
                'Kandungankarbon' => number_format($Kandungankarbon ?? 0, 3, '.', ''),
                'SerapanCO2' => number_format($SerapanCO2 ?? 0, 3, '.', ''),
                'TotalPancangco2' => number_format($TotalPancangco2 ?? 0, 3, '.', ''),
                'TotalPancangkarbon' => number_format($TotalPancangkarbon ?? 0, 3, '.', ''),
                'TotalMangroveKarbondioksida' => number_format($TotalMangroveKarbondioksida ?? 0, 3, '.', ''),
                'TotalMangrovekarbon' => number_format($TotalMangrovekarbon ?? 0, 3, '.', ''),
                'TotalTiangco2' => number_format($TotalTiangco2 ?? 0, 3, '.', ''),
                'TotalTiangKarbon' => number_format($TotalTiangKarbon ?? 0, 3, '.', ''),
                'TotalPohonco2' => number_format($TotalPohonco2 ?? 0, 3, '.', ''),
                'TotalPohonkarbon' => number_format($TotalPohonkarbon ?? 0, 3, '.', ''),
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
                'TanahCo2' => number_format($zona->total_co2_tanah ?? 0, 4, '.', ''),
                'TanahCarbon' => number_format($zona->total_carbon_tanah ?? 0, 4, '.', ''),
                'BeratBiomassaAkar' => number_format($akar ?? 0, 4, '.', ''),
                'tanah' => number_format($tanah ?? 0, 4, '.', ''),
                'beratMasaAkar' => number_format($beratMasaAkar ?? 0, 4, '.', ''),
                'faktor' => number_format($faktor ?? 0, 0, '.', ''),
                'TotalKaoobon' => number_format($TotalKarbon5POL ?? 0, 4, '.', ''),
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
            $constantPancang = 25;
            $TotalPancangco2 = ($zona->pancang_avg_co2 * ($zona->total_pohon_pancang / $constantPancang) * 10000) / 1000;
            $TotalPancangkarbon = ($zona->pancang_avg_kandungan_karbon * ($zona->total_pohon_pancang / $constantPancang) * 10000) / 1000;
            $TotalPancangbiomimasa = ($zona->pancang_avg_bio_di_atas_tanah * ($zona->total_pohon_pancang / $constantPancang) * 10000) / 1000;
            // Perhitungan Mangrove
            $constantMangrove = 25;
            $TotalMangroveKarbondioksida = ($zona->mangrove_avg_karbondioksida * ($zona->total_mangrove / $constantMangrove) * 10000) / 1000;
            $TotalMangrovekarbon = ($zona->mangrove_avg_kandungan_karbon * ($zona->total_mangrove / $constantMangrove) * 10000) / 1000;
            $TotalMangrovebiomimasa = ($zona->mangrove_avg_biomasa * ($zona->total_mangrove / $constantMangrove) * 10000) / 1000;

            // Perhitungan Tiang
            $constantTiang = 100;
            $TotalTiangco2 = ($zona->tiang_avg_co2 * ($zona->total_tiang / $constantTiang) * 10000) / 1000;
            $TotalTiangKarbon = ($zona->tiang_avg_kandungan_karbon * ($zona->total_tiang / $constantTiang) * 10000) / 1000;
            $TotalTiangbiomasa = ($zona->tiang_avg_bio_di_atas_tanah * ($zona->total_tiang / $constantTiang) * 10000) / 1000;

            // Perhitungan Pohon
            $constantPohon = 400;
            $TotalPohonco2 = ($zona->pohon_avg_co2 * ($zona->total_pohon / $constantPohon) * 10000) / 1000;
            $TotalPohonkarbon = ($zona->pohon_avg_kandungan_karbon * ($zona->total_pohon / $constantPohon) * 10000) / 1000;
            $TotalPohonbiomasa = ($zona->pohon_avg_bio_di_atas_tanah * ($zona->total_pohon / $constantPohon) * 10000) / 1000;
            // Perhitungan CO2 dari Serasah (dibagi berdasarkan jumlah nilai unik)
            $zonaid = $zona->id;
            $uniqueSerasah = DB::table('serasah')
                ->leftJoin('subplot', 'serasah.subplot_id', '=', 'subplot.id')
                ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
                ->leftJoin('zona', 'hamparan.zona_id', '=', 'zona.id')
                ->where('zona.polt_area_id', $zonaid)
                ->select('zona.zona as nama_zona', DB::raw('COUNT(DISTINCT serasah.id) as total_serasah'))
                ->groupBy('zona.zona')
                ->get();
            $uniqueSemai = DB::table('semai')
                ->leftJoin('subplot', 'semai.subplot_id', '=', 'subplot.id') // Perbaikan: Menghubungkan semai ke subplot
                ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
                ->leftJoin('zona', 'hamparan.zona_id', '=', 'zona.id')
                ->where('zona.polt_area_id', $zonaid)
                ->select('zona.zona as nama_zona', DB::raw('COUNT(DISTINCT semai.id) as total_semai'))
                ->groupBy('zona.zona') // Mengelompokkan berdasarkan nama zona
                ->get();
            $uniqueTumbuhanBawah = DB::table('tumbuhan_bawah')
                ->leftJoin('subplot', 'tumbuhan_bawah.subplot_id', '=', 'subplot.id')
                ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
                ->leftJoin('zona', 'hamparan.zona_id', '=', 'zona.id')
                ->where('zona.polt_area_id', $zonaid)
                ->select('zona.zona as nama_zona', DB::raw('COUNT(DISTINCT tumbuhan_bawah.id) as total_tumbuhan_bawah'))
                ->groupBy('zona.zona') // Mengelompokkan berdasarkan nama zona
                ->get();
            $uniqueNecromas = DB::table('necromass')
                ->leftJoin('subplot', 'necromass.subplot_id', '=', 'subplot.id')
                ->leftJoin('plot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
                ->leftJoin('zona', 'hamparan.zona_id', '=', 'zona.id')
                ->where('zona.polt_area_id', $zonaid)
                ->select('zona.zona as nama_zona', DB::raw('COUNT(DISTINCT necromass.id) as total_necromass'))
                ->groupBy('zona.zona') // Mengelompokkan berdasarkan nama zona
                ->get();

            $zonaa = Zona::select(
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
                ->leftJoin('hamparan', 'hamparan.zona_id', '=', 'zona.id')

                ->leftJoin('plot', 'plot.hamparan_id', '=', 'hamparan.id')
                ->leftJoin('subplot', 'subplot.plot_id', '=', 'plot.id')
                ->leftJoin('serasah', 'serasah.subplot_id', '=', 'subplot.id')
                ->leftJoin('semai', 'semai.subplot_id', '=', 'subplot.id')
                ->leftJoin('tumbuhan_bawah', 'tumbuhan_bawah.subplot_id', '=', 'subplot.id')
                ->leftJoin('necromass', 'necromass.subplot_id', '=', 'subplot.id')
                ->where('zona.polt_area_id', $zonaid)
                ->whereNull('zona.deleted_at')
                ->first(); //Ambil satu objek, bukan Collection
            // dd($zonaa);
            // dd($uniqueSerasah, $uniqueSemai, $uniqueTumbuhanBawah, $uniqueNecromas);
            $jumlahSerasah = $uniqueSerasah->first()->total_serasah ?? 0;
            $hasilSerasahCo2 = ($jumlahSerasah > 0) ? ($zonaa->serasah_co2 / $jumlahSerasah) : 0;
            $Serasahco2 = ((float) $hasilSerasahCo2 / 1000000) * 10000;

            $hasilSerasahKarbon = ($jumlahSerasah > 0) ? ($zonaa->serasah_kandungan_karbon / $jumlahSerasah) : 0;
            $SerasahKarbon = ((float) $hasilSerasahKarbon / 1000000) * 10000;

            $hasilSerasahberatkering = ($jumlahSerasah > 0) ? ($zonaa->serasah_total_berat_kering / $jumlahSerasah) : 0;
            $Serasahberatkering = ((float) $hasilSerasahberatkering / 1000000) * 10000;
            // semai
            $jumlahSemai = $uniqueSemai->first()->total_semai ?? 0;

            $hasilsemaiCo2 = ($jumlahSemai > 0) ? ($zonaa->semai_co2 / $jumlahSemai) : 0;
            $semaico2 = ((float) $hasilsemaiCo2 / 1000000) * 10000;

            $hasilsemaiKarbon = ($jumlahSemai > 0) ? ($zonaa->semai_kandungan_karbon / $jumlahSemai) : 0;
            $semaiKarbon = ((float) $hasilsemaiKarbon / 1000000) * 10000;

            $hasilsemaiberatkering = ($jumlahSemai > 0) ? ($zonaa->semai_total_berat_kering / $jumlahSemai) : 0;
            $semaiberatkering = ((float) $hasilsemaiberatkering / 1000000) * 10000;
            // tumbuhan bah
            $jumlahTumbuhanBawah = $uniqueTumbuhanBawah->first()->total_tumbuhan_bawah ?? 0;
            $hasiltumbuhan_bawahCo2 = ($jumlahTumbuhanBawah > 0) ? ($zonaa->tumbuhan_bawah_co2 / $jumlahTumbuhanBawah) : 0;
            $tumbuhan_bawahco2 = ((float) $hasiltumbuhan_bawahCo2 / 1000000) * 10000;

            $hasiltumbuhan_bawahKarbon = ($jumlahTumbuhanBawah > 0) ? ($zonaa->tumbuhan_bawah_kandungan_karbon / $jumlahTumbuhanBawah) : 0;
            $tumbuhan_bawahKarbon = ((float) $hasiltumbuhan_bawahKarbon / 1000000) * 10000;

            $hasiltumbuhan_bawahberatkering = ($jumlahTumbuhanBawah > 0) ? ($zonaa->tumbuhan_bawah_total_berat_kering / $jumlahTumbuhanBawah) : 0;
            $tumbuhan_bawahberatkering = ((float) $hasiltumbuhan_bawahberatkering / 1000000) * 10000;


            // Konversi nilai Necromass
            $jumlahNecromas = $uniqueNecromas->first()->total_necromass ?? 0;

            $hasilNecromashCo2 = ($jumlahNecromas > 0) ? ($zonaa->necromass_co2 / $jumlahNecromas) : 0;
            $Necromassco2 = ((float) $hasilNecromashCo2 / 1000000) * 10000 / 400;

            $hasilNecromasbiomasa = ($jumlahNecromas > 0) ? ($zonaa->necromass_total_biomasa / $jumlahNecromas) : 0;
            $Necromassbiomasa = ((float) $hasilNecromasbiomasa / 1000000) * 10000 / 400;

            $hasilNecromascarbon = ($jumlahNecromas > 0) ? ($zonaa->necromass_total_carbon / $jumlahNecromas) : 0;
            $NecromassCarbon = ((float) $hasilNecromascarbon / 1000000) * 10000 / 400;
            // klandungan karbon
            $Biomassadiataspermukaantanah = $TotalPancangbiomimasa +  $TotalTiangbiomasa + $TotalPohonbiomasa + $Serasahberatkering +  $semaiberatkering +  $tumbuhan_bawahberatkering +   $Necromassbiomasa;
            $Kandungankarbon = $TotalPancangkarbon +  $TotalTiangKarbon + $TotalPohonkarbon + $SerasahKarbon +  $semaiKarbon + $tumbuhan_bawahKarbon + $NecromassCarbon;
            $SerapanCO2  = $TotalPancangco2 + $TotalTiangco2 +   $TotalPohonco2 +  $Serasahco2 +  $semaico2 +  $tumbuhan_bawahco2 +  $Necromassco2;
            // TootaL Karbon
            $TotalKandunganKarbon =  $zona->total_carbon_tanah + $hasilNecromascarbon + $SerasahKarbon + $semaiKarbon  + $tumbuhan_bawahKarbon + $TotalPohonkarbon + $TotalPancangkarbon + $TotalTiangKarbon;
            // Total carbon tanama kandungan karbon
            $TotalCarbon =  $semaico2   + $TotalPohonco2 + $TotalPancangco2 + $TotalTiangco2 + $tumbuhan_bawahco2;
            // serapan co2
            // Total berat biomassa tanaman/ AKAR
            $totalBerat = $TotalPancangco2 + $TotalTiangco2 + $TotalPohonco2;
            $beratMasaAkar = $totalBerat * 0.37;
            // total karbon ]
            $KarbonCo2 = $TotalPancangco2 + $beratMasaAkar + $TotalTiangco2 + $TotalPohonco2  + $Serasahco2 + $semaico2 + $tumbuhan_bawahco2 + $hasilNecromashCo2;
            // Pendekatan Kerapatan

            // Total CO2 dari tanaman
            $Co2Tanamannn = $TotalPancangco2 + $TotalTiangco2 + $TotalPohonco2;
            $totalCo2Lokasi = $Co2Tanamannn * $faktor;

            // Faktor konversi CO2
            $Serasa = $Serasahco2 * $faktor;
            $Necromass = $Necromassco2 * $faktor;
            $co2tanaman = $Co2Tanamannn * $faktor;
            $akar = $beratMasaAkar * $faktor; // Asumsi biomassa akar tanpa perubahan
            $tanah = $zona->total_co2_tanah * $faktor;
            $tanah = $zona->total_co2_tanah * $faktor;
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
                'zona' => $zona->zona_nama,
                'Biomassadiataspermukaantanah' => number_format($Biomassadiataspermukaantanah ?? 0, 3, '.', ''),
                'Kandungankarbon' => number_format($Kandungankarbon ?? 0, 3, '.', ''),
                'SerapanCO2' => number_format($SerapanCO2 ?? 0, 3, '.', ''),
                'TotalPancangco2' => number_format($TotalPancangco2 ?? 0, 3, '.', ''),
                'TotalPancangkarbon' => number_format($TotalPancangkarbon ?? 0, 3, '.', ''),
                'TotalMangroveKarbondioksida' => number_format($TotalMangroveKarbondioksida ?? 0, 3, '.', ''),
                'TotalMangrovekarbon' => number_format($TotalMangrovekarbon ?? 0, 3, '.', ''),
                'TotalTiangco2' => number_format($TotalTiangco2 ?? 0, 3, '.', ''),
                'TotalTiangKarbon' => number_format($TotalTiangKarbon ?? 0, 3, '.', ''),
                'TotalPohonco2' => number_format($TotalPohonco2 ?? 0, 3, '.', ''),
                'TotalPohonkarbon' => number_format($TotalPohonkarbon ?? 0, 3, '.', ''),
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
                'TanahCo2' => number_format($zona->total_co2_tanah ?? 0, 4, '.', ''),
                'TanahCarbon' => number_format($zona->total_carbon_tanah ?? 0, 4, '.', ''),
                'BeratBiomassaAkar' => number_format($akar ?? 0, 4, '.', ''),
                'tanah' => number_format($tanah ?? 0, 4, '.', ''),
                'beratMasaAkar' => number_format($beratMasaAkar ?? 0, 4, '.', ''),
                'faktor' => number_format($faktor ?? 0, 0, '.', ''),
                'TotalKaoobon' => number_format($TotalKarbon5POL ?? 0, 4, '.', ''),
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
