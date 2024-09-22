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
use Illuminate\Http\Request;

class RingkasanController extends Controller
{
    public function akar($polt_area)
    {
        // Mendapatkan rata-rata dari kolom tertentu (misal: 'co2') berdasarkan polt-area_id
        $pancang = Pancang::where("polt-area_id", $polt_area)->avg('co2');
        // Menghitung jumlah baris yang ada berdasarkan polt-area_id
        $totalRows = Pancang::where('polt-area_id', $polt_area)->count();

        // Nilai konstan dari $C$2 (misalnya 25)
        $constantValue = 25;

        // Rumus perhitungan
        $TotalPancang = (($pancang) * ($totalRows / $constantValue) * 10000) / 1000;
        // Mendapatkan rata-rata dari kolom tertentu (misal: 'co2') berdasarkan polt-area_id
        $Tiang = Tiang::where("polt-area_id", $polt_area)->avg('co2');
        // Menghitung jumlah baris yang ada berdasarkan polt-area_id
        $totalRows = Tiang::where('polt-area_id', $polt_area)->count();

        // Nilai konstan dari $C$2 (misalnya 25)
        $constantValue = 100;

        // Rumus perhitungan
        $TotalTiang = (($Tiang) * ($totalRows / $constantValue) * 10000) / 1000;
        // Mendapatkan rata-rata dari kolom tertentu (misal: 'co2') berdasarkan polt-area_id
        $Pohon = Pohon::where("polt-area_id", $polt_area)->avg('co2');
        // Menghitung jumlah baris yang ada berdasarkan polt-area_id
        $totalRows = Pohon::where('polt-area_id', $polt_area)->count();

        // Nilai konstan dari $C$2 (misalnya 25)
        $constantValue = 400;

        // Rumus perhitungan
        $TotalPohon = (($Pohon) * ($totalRows / $constantValue) * 10000) / 1000;

        $totalBerat = $TotalPancang + $TotalTiang + $TotalPohon;
        $beratMasa = $totalBerat * 0.37;
        return response()->json([
            "pancang" => $TotalPancang,
            "tiang" => $TotalTiang,
            "pohon" => $TotalPohon,
            "TOTAL BERAT MASA" => $totalBerat,
            "bioma" => $beratMasa,
        ], 202);
    }
    public function ringkasan($polt_area)
    {
        // Mendapatkan rata-rata dari kolom tertentu (misal: 'co2') berdasarkan polt-area_id
        $pancangco2 = Pancang::where("polt-area_id", $polt_area)->avg('co2');
        $pancangkarbon = Pancang::where("polt-area_id", $polt_area)->avg('kandungan_karbon');
        // Menghitung jumlah baris yang ada berdasarkan polt-area_id
        $totalRows = Pancang::where('polt-area_id', $polt_area)->count();

        // Nilai konstan dari $C$2 (misalnya 25)
        $constantValue = 25;

        // Rumus perhitungan
        $TotalPancangco2 = (($pancangco2) * ($totalRows / $constantValue) * 10000) / 1000;
        $TotalPancangkarbon = (($pancangkarbon) * ($totalRows / $constantValue) * 10000) / 1000;
        // Mendapatkan rata-rata dari kolom tertentu (misal: 'co2') berdasarkan polt-area_id
        $Tiangco2 = Tiang::where("polt-area_id", $polt_area)->avg('co2');
        $Tiangkarbon = Tiang::where("polt-area_id", $polt_area)->avg('kandungan_karbon');
        // Menghitung jumlah baris yang ada berdasarkan polt-area_id
        $totalRows = Tiang::where('polt-area_id', $polt_area)->count();

        // Nilai konstan dari $C$2 (misalnya 25)
        $constantValue = 100;

        // Rumus perhitungan
        $TotalTiangco2 = (($Tiangco2) * ($totalRows / $constantValue) * 10000) / 1000;
        $TotalTiangkarbon = (($Tiangkarbon) * ($totalRows / $constantValue) * 10000) / 1000;
        // Mendapatkan rata-rata dari kolom tertentu (misal: 'co2') berdasarkan polt-area_id
        $Pohonco2 = Pohon::where("polt-area_id", $polt_area)->avg('co2');
        $Pohonkarbon = Pohon::where("polt-area_id", $polt_area)->avg('kandungan_karbon');
        // Menghitung jumlah baris yang ada berdasarkan polt-area_id
        $totalRows = Pohon::where('polt-area_id', $polt_area)->count();

        // Nilai konstan dari $C$2 (misalnya 25)
        $constantValue = 400;

        // Rumus perhitungan
        $TotalPohonco2 = (($Pohonco2) * ($totalRows / $constantValue) * 10000) / 1000;
        $TotalPohonco2 = (($Pohonkarbon) * ($totalRows / $constantValue) * 10000) / 1000;

        $totalBerat = $TotalPancangco2 + $TotalTiangco2 + $TotalPohonco2;
        $beratMasa = $totalBerat * 0.37;



        // Menghitung total dari kolom 'co2'
        $SerasahTotalco2 = Serasah::where("polt-area_id", $polt_area)->sum('co2');
        $SerasahTotalKarbon = Serasah::where("polt-area_id", $polt_area)->sum('kandungan_karbon');

        // Menghitung jumlah nilai unik dari kolom 'total_berat_basah'
        $uniqueBeratBasah = Serasah::distinct('total_berat_basah')->count('total_berat_basah');

        // Menghitung hasil akhir (total / jumlah unik)
        if ($uniqueBeratBasah > 0) {
            $hasilco2 = $SerasahTotalco2 / $uniqueBeratBasah;
        } else {
            $hasilco2 = 0;
        }
        $Serasahco2 = ($hasilco2 / 1000000) * 10000;
        if ($uniqueBeratBasah > 0) {
            $hasilkarbon = $SerasahTotalKarbon / $uniqueBeratBasah;
        } else {
            $hasilkarbon = 0;
        }
        $Serasahkarbon = ($hasilkarbon / 1000000) * 10000;
        // Menghitung total dari kolom 'co2'
        $SemaiTotalCo2 = Semai::where("polt-area_id", $polt_area)->sum('co2');
        $SemaiTotalKarbon = Semai::where("polt-area_id", $polt_area)->sum('kandungan_karbon');

        // Menghitung jumlah nilai unik dari kolom 'total_berat_basah'
        $uniqueBeratBasah = Semai::distinct('total_berat_basah')->count('total_berat_basah');

        // Menghitung hasil akhir (total / jumlah unik)
        if ($uniqueBeratBasah > 0) {
            $hasilCo2 = $SemaiTotalCo2 / $uniqueBeratBasah;
        } else {
            $hasilCo2 = 0;
        }
        $Semaico2 = ($hasilCo2 / 1000000) * 10000;
        if ($uniqueBeratBasah > 0) {
            $hasilkarbon = $SemaiTotalKarbon / $uniqueBeratBasah;
        } else {
            $hasilkarbon = 0;
        }
        $SemaiKarbon = ($hasilkarbon / 1000000) * 10000;

        // Menghitung total dari kolom 'co2'
        $TumbuhanTotalCo2 = TumbuhanBawah::where("polt-area_id", $polt_area)->sum('co2');
        $TumbuhanTotalKarbon = TumbuhanBawah::where("polt-area_id", $polt_area)->sum('co2');

        // Menghitung jumlah nilai unik dari kolom 'total_berat_basah'
        $uniqueBeratBasah = TumbuhanBawah::distinct('total_berat_basah')->count('total_berat_basah');

        // Menghitung hasil akhir (total / jumlah unik)
        if ($uniqueBeratBasah > 0) {
            $hasilco2 = $TumbuhanTotalCo2 / $uniqueBeratBasah;
        } else {
            $hasilco2 = 0;
        }
        $Tumbuhanco2 = ($hasilco2 / 1000000) * 10000;
        if ($uniqueBeratBasah > 0) {
            $hasilKarbon = $TumbuhanTotalKarbon / $uniqueBeratBasah;
        } else {
            $hasilKarbon = 0;
        }
        $TumbuhanKarbon = ($hasilKarbon / 1000000) * 10000;
        // Menghitung total dari kolom 'co2'
        $NecromassTotalCo2 = Necromass::where("polt-area_id", $polt_area)->sum('co2');
        $NecromassTotalKarbon = Necromass::where("polt-area_id", $polt_area)->sum('carbon');

        // Menghitung jumlah nilai unik dari kolom 'berat_jenis_kayu'
        $uniqueBeratBasah = Necromass::distinct('berat_jenis_kayu')->count('berat_jenis_kayu');

        // Menghitung hasil akhir (total / jumlah unik)
        if ($uniqueBeratBasah > 0) {
            $hasilCo2 = $NecromassTotalCo2 / $uniqueBeratBasah;
        } else {
            $hasilCo2 = 0;
        }
        $Necromasnco2 = ($hasilCo2 / 1000000) * 10000 / 400;
        if ($uniqueBeratBasah > 0) {
            $hasilKarbon = $NecromassTotalKarbon / $uniqueBeratBasah;
        } else {
            $hasilKarbon = 0;
        }
        $NecromasnKarbon = ($hasilKarbon / 1000000) * 10000 / 400;

        // Menghitung total dari kolom 'co2'
        $totalco2tanah = Tanah::where("polt-area_id", $polt_area)->sum('co2kg');

        // Total ringkasan 
        $Co2Tanaman = $Semaico2 + $TotalPancangco2 + $TotalTiangco2 + $TotalPohonco2;
        $Serasa = $Serasahco2 * 11.5;
        $Necromass = $Necromasnco2 * 11.5;
        $co2tanaman = $Co2Tanaman * 11.5;
        $tanah = $totalco2tanah * 1;
        $akar = $beratMasa * 1;
        $TotalKarbon = $Serasa + $Necromass + $co2tanaman + $tanah + $akar;
        $BaselineLahanKosong = $TotalKarbon - (((10 + 4) / 2) * 11.5);
        // Mengembalikan hasil dalam JSON atau sesuai kebutuhan
        return response()->json([
            "CO2",
            'Serasah' => number_format($Serasa, 2, '.', ''),
            'Necromass' => number_format($Necromass, 2, '.', ''),
            'Co2 Tanaman' =>  number_format($co2tanaman, 2, '.', ''),
            'Tanah' => number_format($tanah, 2, '.', ''),
            "Berat Biomassa Akar" =>  number_format($akar, 2, '.', ''),
            'Total Carbon 5 Pool (ton)' => number_format($TotalKarbon, 2, '.', ''),
            "Baseline Lahan Kosongh" => number_format($BaselineLahanKosong, 2, '.', ''),

        ], 200);
        // return response()->json([
        //     "TOTAL BERAT MASA" => $totalBerat,
        //     "bioma" => $beratMasa,
        // ], 202);
    }
}
