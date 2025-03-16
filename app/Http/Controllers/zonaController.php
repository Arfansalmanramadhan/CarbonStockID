<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\PoltArea;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Pancang;
use App\Models\Tiang;
use App\Models\Pohon;
use App\Models\Serasah;
use App\Models\Semai;
use App\Models\TumbuhanBawah;
use App\Models\Necromass;
use App\Models\Tanah;

class zonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->query('search');
        $perPage = $request->query('per_page', 5);
        $query = Zona::query();
        if (!empty($search)) {
            $query->where('zona', 'ILIKE', "%{$search}%")
                ->orWhere('jenis_hutan', 'ILIKE', "%{$search}%");
        }

        // $poltArea = $query->paginate($perPage);

        /// Ambil data dengan pagination
        $zona = $query->paginate($perPage)->appends([
            'search' => $search,
            'per_page' => $perPage
        ]);
        return view('zona', compact('zona', "user", 'search', 'perPage'));
    }
    public function getZona(Request $request, $slug)
    {
        $user = Auth::user();
        $search = $request->query('search');
        $perPage = $request->query('per_page', 5);
        $poltArea = PoltArea::where("slug", $slug)->first();
        // dd($poltArea);

        $query = Zona::where("polt_area_id", $poltArea->id);
        if (!empty($search)) {
            $query->where('zona', 'ILIKE', "%{$search}%")
                ->orWhere('jenis_hutan', 'ILIKE', "%{$search}%");
        }

        // $poltArea = $query->paginate($perPage);

        /// Ambil data dengan pagination
        $zona = $query->paginate($perPage)->appends([
            'search' => $search,
            'per_page' => $perPage
        ]);
        $ringkasan = $this->ringkasan($slug)->getData()['ringkasan'];
        return view('show.zona', compact('zona', "user", 'search', 'perPage', 'poltArea', 'ringkasan'));
    }
    public function tambah($slug)
    {
        $user = Auth::user();
        $poltArea = PoltArea::where('slug', $slug)->firstOrFail();
        return view('tambah.TambahZona', compact('user', 'poltArea'));
    }

    public function create($slug)
    {
        $user = Auth::user();
        $poltArea = PoltArea::where('slug', $slug)->firstOrFail();
        return view('tambah.TambahZona', compact('poltArea'));
    }

    public function store(Request $request, $slug)
    {
        $validatedData = $request->validate([
            'zona' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'jenis_hutan' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $poltArea = PoltArea::where('slug', $slug)->firstOrFail();

            $zona = Zona::create([
                'polt_area_id' => $poltArea->id,
                'zona' => $validatedData['zona'],
                'latitude' => $validatedData['latitude'],
                'longitude' => $validatedData['longitude'],
                'jenis_hutan' => $validatedData['jenis_hutan'],
                'slug' => Str::slug($validatedData['zona']),
            ]);

            DB::commit();
            return redirect()->route('zona.getZona', ['slug' => $slug])->with('success', 'Zona berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slugP, $slugZ)
    {
        // $user = Auth::user();
        $poltArea = PoltArea::where('slug', $slugP)->firstOrFail();
        $zona = Zona::where('slug', $slugZ)->where('polt_area_id', $poltArea->id)->firstOrFail();

        return view('edit.zona', compact('poltArea', 'zona'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slugP, $slugZ)
    {
        $validatedData = $request->validate([
            'zona' => 'required|string|max:255|unique:zona,zona,' . $slugZ . ',slug',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'jenis_hutan' => 'required|string|max:255',
        ]);
        DB::beginTransaction();
        try {
            $poltArea = PoltArea::where('slug', $slugP)->firstOrFail();
            $zona = Zona::where('slug', $slugZ)->where('polt_area_id', $poltArea->id)->firstOrFail();

            $zona->update([
                'zona' => $validatedData['zona'],
                'latitude' => $validatedData['latitude'],
                'longitude' => $validatedData['longitude'],
                'jenis_hutan' => $validatedData['jenis_hutan'],
                'slug' => Str::slug($validatedData['zona']),
            ]);

            DB::commit();
            return redirect()->route('zona.getZona', ['slug' => $slugP])->with('success', 'Zona berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function ringkasan($slug)
    {
        $poltArea = PoltArea::where('slug', $slug)->firstOrFail();
        // if (!$poltArea) {
        //     abort(404, 'Polt Area tidak ditemukan.');
        // }

        $ringkasan = Zona::where('zona.polt_area_id', $poltArea->id)
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
                DB::raw('COUNT(pancang.no_pohon) as total_pohonPancang'),
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
                // Serasah
                DB::raw('SUM(serasah.total_berat_kering) as serasah_total_berat_kering'),
                DB::raw('SUM(serasah.kandungan_karbon) as serasah_kandungan_karbon'),
                DB::raw('SUM(serasah.co2) as serasah_co2'),
                // semai
                DB::raw('SUM(semai.total_berat_kering) as semai_total_berat_kering'),
                DB::raw('SUM(semai.kandungan_karbon) as semai_kandungan_karbon'),
                DB::raw('SUM(semai.co2) as semai_co2'),
                // tumbuhan_bawah
                DB::raw('SUM(tumbuhan_bawah.total_berat_kering) as tumbuhan_bawah_total_berat_kering'),
                DB::raw('SUM(tumbuhan_bawah.kandungan_karbon) as tumbuhan_bawah_kandungan_karbon'),
                DB::raw('SUM(tumbuhan_bawah.co2) as tumbuhan_bawah_co2'),
                // Necromass
                DB::raw('SUM(necromass.co2) as necromass_total_co2'),
                DB::raw('SUM(necromass.biomasa) as necromass_total_biomasa'),
                DB::raw('SUM(necromass.carbon) as necromass_total_carbon'),
                // Tanah
                DB::raw('SUM(tanah.carbonkg) as total_carbon_tanah'),
                DB::raw('SUM(tanah.co2kg) as total_co2_tanah')
            )
            // ->where('slug',$slug)
            ->groupBy('zona.id', 'zona.zona', 'zona.polt_area_id', 'polt_area.luas_lokasi')
            ->get();
        // Lakukan perhitungan tambahan untuk masing-masing zona
        $result = $ringkasan->map(function ($zona) {
            $faktor = ((float) $zona->luas_lokasi) > 0 ? (float) $zona->luas_lokasi : 11.5;
            // Perhitungan Pancang
            $constantPancang = 25;
            $TotalPancangco2 = ($zona->pancang_avg_co2 * ($zona->total_pohonPancang / $constantPancang) * 10000) / 1000;
            $TotalPancangkarbon = ($zona->pancang_avg_kandungan_karbon * ($zona->total_pohonPancang / $constantPancang) * 10000) / 1000;
            $TotalPancangbiomimasa = ($zona->pancang_avg_bio_di_atas_tanah * ($zona->total_pohonPancang / $constantPancang) * 10000) / 1000;
            // Perhitungan Mangrove
            $constantMangrove = 25;
            $TotalMangroveKarbondioksida = ($zona->mangrove_avg_karbondioksida * ($zona->total_pohonMangrove / $constantMangrove) * 10000) / 1000;
            $TotalMangrovekarbon = ($zona->mangrove_avg_kandungan_karbon * ($zona->total_pohonMangrove / $constantMangrove) * 10000) / 1000;
            $TotalMangrovebiomimasa = ($zona->mangrove_avg_biomasa * ($zona->total_pohonMangrove / $constantMangrove) * 10000) / 1000;

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
                ->join('subplot', 'serasah.subplot_id', '=', 'subplot.id')
                ->join('plot', 'subplot.plot_id', '=', 'plot.id')
                ->join('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
                ->join('zona', 'hamparan.zona_id', '=', 'zona.id')
                ->where('zona.id', $zona->zona_id)
                ->distinct()
                ->count(); // Ambil jumlah unik zona_id
            $uniqueSemai = DB::table('semai')
                ->join('subplot', 'semai.subplot_id', '=', 'subplot.id')
                ->join('plot', 'subplot.plot_id', '=', 'plot.id')
                ->join('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
                ->join('zona', 'hamparan.zona_id', '=', 'zona.id')
                ->where('zona.id', $zona->zona_id)
                ->distinct()
                ->count();
            $uniqueTumbuhanBawah = DB::table('tumbuhan_bawah')
                ->join('subplot', 'tumbuhan_bawah.subplot_id', '=', 'subplot.id')
                ->join('plot', 'subplot.plot_id', '=', 'plot.id')
                ->join('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
                ->join('zona', 'hamparan.zona_id', '=', 'zona.id')
                ->where('zona.id', $zona->zona_id)
                ->distinct()
                ->count();
            $uniqueNecromas = DB::table('necromass')
                ->join('subplot', 'necromass.subplot_id', '=', 'subplot.id')
                ->join('plot', 'subplot.plot_id', '=', 'plot.id')
                ->join('hamparan', 'plot.hamparan_id', '=', 'hamparan.id')
                ->join('zona', 'hamparan.zona_id', '=', 'zona.id')
                ->where('zona.id', $zona->zona_id)
                ->distinct()
                ->count();

            $zona = Zona::where('zona.id', $zona->zona_id)
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

            $hasilSerasahCo2 = ($uniqueSerasah > 0) ? ($zona->serasah_co2 / $uniqueSerasah) : 0;
            $Serasahco2 = ((float) $hasilSerasahCo2 / 1000000) * 10000;

            $hasilSerasahKarbon = ($uniqueSerasah > 0) ? ($zona->serasah_kandungan_karbon / $uniqueSerasah) : 0;
            $SerasahKarbon = ((float) $hasilSerasahKarbon / 1000000) * 10000;

            $hasilSerasahberatkering = ($uniqueSerasah > 0) ? ($zona->serasah_total_berat_kering / $uniqueSerasah) : 0;
            $Serasahberatkering = ((float) $hasilSerasahberatkering / 1000000) * 10000;
            // semai
            $hasilsemaiCo2 = ($uniqueSemai > 0) ? ($zona->semai_co2 / $uniqueSemai) : 0;
            $semaico2 = ((float) $hasilsemaiCo2 / 1000000) * 10000;

            $hasilsemaiKarbon = ($uniqueSemai > 0) ? ($zona->semai_kandungan_karbon / $uniqueSemai) : 0;
            $semaiKarbon = ((float) $hasilsemaiKarbon / 1000000) * 10000;

            $hasilsemaiberatkering = ($uniqueSemai > 0) ? ($zona->semai_total_berat_kering / $uniqueSemai) : 0;
            $semaiberatkering = ((float) $hasilsemaiberatkering / 1000000) * 10000;
            // tumbuhan bah
            $hasiltumbuhan_bawahCo2 = ($uniqueTumbuhanBawah > 0) ? ($zona->tumbuhan_bawah_co2 / $uniqueTumbuhanBawah) : 0;
            $tumbuhan_bawahco2 = ((float) $hasiltumbuhan_bawahCo2 / 1000000) * 10000;

            $hasiltumbuhan_bawahKarbon = ($uniqueTumbuhanBawah > 0) ? ($zona->tumbuhan_bawah_kandungan_karbon / $uniqueTumbuhanBawah) : 0;
            $tumbuhan_bawahKarbon = ((float) $hasiltumbuhan_bawahKarbon / 1000000) * 10000;

            $hasiltumbuhan_bawahberatkering = ($uniqueTumbuhanBawah > 0) ? ($zona->tumbuhan_bawah_total_berat_kering / $uniqueTumbuhanBawah) : 0;
            $tumbuhan_bawahberatkering = ((float) $hasiltumbuhan_bawahberatkering / 1000000) * 10000;


            // Konversi nilai Necromass
            $hasilNecromashCo2 = ($uniqueNecromas > 0) ? ($zona->necromass_co2 / $uniqueNecromas) : 0;
            $Necromassco2 = ((float) $hasilNecromashCo2 / 1000000) * 10000 / 400;

            $hasilNecromasbiomasa = ($uniqueNecromas > 0) ? ($zona->necromass_total_biomasa / $uniqueNecromas) : 0;
            $Necromassbiomasa = ((float) $hasilNecromasbiomasa / 1000000) * 10000 / 400;

            $hasilNecromascarbon = ($uniqueNecromas > 0) ? ($zona->necromass_total_carbon / $uniqueNecromas) : 0;
            $NecromassCarbon = ((float) $hasilNecromascarbon / 1000000) * 10000 / 400;
            // klandungan karbon
            // TootaL Karbon
            $TotalKandunganKarbon =  $zona->total_carbon_tanah + $NecromassCarbon + $SerasahKarbon + $semaiKarbon  + $tumbuhan_bawahKarbon + $TotalPohonkarbon + $TotalPancangkarbon + $TotalTiangKarbon + $TotalMangrovekarbon;
            // Total carbon tanama kandungan karbon
            $TotalCarbon =  $semaiKarbon   + $TotalPohonkarbon + $TotalPancangkarbon + $TotalTiangKarbon;
            // serapan co2
            // Total berat biomassa tanaman/ AKAR
            $totalBerat = $TotalPancangco2 + $TotalTiangco2 + $TotalPohonco2;
            $beratMasaAkar = $totalBerat * 0.37;
            // total karbon ]
            $KarbonCo2 = $TotalPancangco2 + $beratMasaAkar + $TotalTiangco2 + $TotalPohonco2 + $TotalMangroveKarbondioksida + $Serasahco2 + $semaico2 + $tumbuhan_bawahco2;

            // Total CO2 dari tanaman
            $Co2Tanamannn = $TotalPancangco2 + $TotalTiangco2 + $TotalPohonco2 + $TotalMangroveKarbondioksida;
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
            // persen
            $hasilSerasahPersen = ($Serasa != 0) ? ($TotalKarbon5POL / $Serasa) * 100 : 0;
            $hasilNecromassPersen = ($Necromass != 0) ? ($TotalKarbon5POL / $Necromass) * 100 : 0;
            $hasilco2tanamanPersen = ($co2tanaman != 0) ? ($TotalKarbon5POL / $co2tanaman) * 100 : 0;
            $hasilakarPersen = ($akar != 0) ? ($TotalKarbon5POL / $akar) * 100 : 0;
            $hasiltanahPersen = ($tanah != 0) ? ($TotalKarbon5POL / $tanah) * 100 : 0;
            // Perhitungan Baseline Lahan Kosong
            $BaselineLahanKosong = $TotalKarbon5POL - (((10 + 4) / 2) * $faktor);

            return [
                'zona' => $zona->zona_nama,
                'TotalPancangco2' => number_format($TotalPancangco2 ?? 0, 2, '.', ''),
                'TotalPancangkarbon' => number_format($TotalPancangkarbon ?? 0, 2, '.', ''),
                'TotalMangroveKarbondioksida' => number_format($TotalMangroveKarbondioksida ?? 0, 2, '.', ''),
                'TotalMangrovekarbon' => number_format($TotalMangrovekarbon ?? 0, 2, '.', ''),
                'TotalTiangco2' => number_format($TotalTiangco2 ?? 0, 2, '.', ''),
                'TotalTiangKarbon' => number_format($TotalTiangKarbon ?? 0, 2, '.', ''),
                'TotalPohonco2' => number_format($TotalPohonco2 ?? 0, 2, '.', ''),
                'TotalPohonkarbon' => number_format($TotalPohonkarbon ?? 0, 2, '.', ''),
                'Serasahco2' => number_format($Serasahco2 ?? 0, 2, '.', ''),
                'SerasahKarbon' => number_format($SerasahKarbon ?? 0, 2, '.', ''),
                'semaico2' => number_format($semaico2 ?? 0, 2, '.', ''),
                'semaiKarbon' => number_format($semaiKarbon ?? 0, 2, '.', ''),
                'tumbuhanbawahco2' => number_format($tumbuhan_bawahco2 ?? 0, 2, '.', ''),
                'tumbuhanbawahkarbon' => number_format($tumbuhan_bawahKarbon ?? 0, 2, '.', ''),
                'Necromassco2' => number_format($Necromassco2 ?? 0, 2, '.', ''),
                'NecromassCarbon' => number_format($NecromassCarbon ?? 0, 2, '.', ''),
                'TotalKandunganKarbon' => number_format($TotalKandunganKarbon ?? 0, 2, '.', ''),
                'KarbonCo2' => number_format($KarbonCo2 ?? 0, 2, '.', ''),
                'TotalCarbonn' => number_format($TotalCarbon ?? 0, 2, '.', ''),
                'Serasah' => number_format($Serasa ?? 0, 2, '.', ''),
                'Necromass' => number_format($Necromass ?? 0, 2, '.', ''),
                'Co2Tanaman' => number_format($co2tanaman ?? 0, 2, '.', ''),
                'TanahCo2' => number_format($zona->total_co2_tanah ?? 0, 2, '.', ''),
                'TanahCarbon' => number_format($zona->total_carbon_tanah ?? 0, 2, '.', ''),
                'BeratBiomassaAkar' => number_format($akar ?? 0, 2, '.', ''),
                'tanah' => number_format($tanah ?? 0, 2, '.', ''),
                'beratMasaAkar' => number_format($beratMasaAkar ?? 0, 2, '.', ''),
                'faktor' => number_format($faktor ?? 0, 2, '.', ''),
                'TotalKaoobon' => number_format($TotalKarbon5POL ?? 0, 2, '.', ''),
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
        dd($ringkasan);
        // dd( $result);
        return view('show.zona', compact('ringkasan', 'poltArea', ), );
    }
}
