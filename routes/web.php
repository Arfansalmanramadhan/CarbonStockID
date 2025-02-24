<?php

use App\Models\Pohon;
use App\Models\Semai;
use App\Models\Tanah;
use App\Models\Tiang;
use App\Models\Pancang;
// use App\Models\Profil;
use App\Models\Serasah;
use App\Models\PoltArea;
use App\Models\Necromass;
use App\Models\TumbuhanBawah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PohonController;
use App\Http\Controllers\SemaiController;
use App\Http\Controllers\TanahController;
use App\Http\Controllers\TiangController;
use App\Http\Controllers\PancangContrller;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SerasahController;
use App\Http\Controllers\NekromasController;
use App\Http\Controllers\PoltAreaController;
use App\Http\Controllers\TunmbuhanBawahController;
use App\Http\Controllers\PanduanController;
use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\DataPlotController;
use App\Http\Controllers\HamparanController;
use App\Http\Controllers\ManajermenUserController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\RingkasanController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\SUrveyorController;
use App\Http\Controllers\zonaController;
use App\Models\Role;
use Illuminate\Routing\Route as RoutingRoute;

// use App\Models\PlotArea;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landingPage');
});

// Rute untuk halaman login
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('only_guest');
    Route::post('/login', 'login')->middleware('only_guest');
    Route::get('/register', 'registasii')->name('register')->middleware('only_guest');
    Route::post('/register', 'registasi')->name('daftar')->middleware('only_guest');
    Route::post('/logout', 'logout')->name('logout');
});
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        $user = Auth::user();
        $poltArea = PoltArea::where('id', $user->id)->first();
        return view('dashboard', compact('user',  'poltArea')); // Kirim $profil ke view
    })->name('dashboard');


    // Route untuk halaman tambah data
    Route::get('/tambahData', function () {
        $user = Auth::user();
        // $profil = Profil::where('id', $user->id)->first();
        $poltArea = PoltArea::where('id', $user->id)->first();
        $serasah = Serasah::where('polt-area_id', $user->id)->first();
        $semai = Semai::where('polt-area_id', $user->id)->first();
        $tanah = Tanah::where('polt-area_id', $user->id)->first();
        $tumbuhanbawah = TumbuhanBawah::where('polt-area_id', $user->id)->first();
        $pohon = Pohon::where('polt-area_id', $user->id)->first();
        $pancang = Pancang::where('polt-area_id', $user->id)->first();
        $tiang = Tiang::where('polt-area_id', $user->id)->first();
        $nekromas = Necromass::where('polt-area_id', $user->id)->first();
        // dd($user, $profil, $poltArea);
        return view('tambahData', compact('user',  'poltArea', 'serasah', 'semai', 'tanah', 'pancang', 'tiang', 'nekromas', 'pohon', 'tumbuhanbawah'));
    });

    Route::get('/percobaan', function () {
        $user = Auth::user();
        // $profil = Profil::where('id', $user->id)->first();
        $poltArea = PoltArea::where('id', $user->id)->first();
        $serasah = Serasah::where('polt-area_id', $user->id)->first();
        $semai = Semai::where('polt-area_id', $user->id)->first();
        $tanah = Tanah::where('polt-area_id', $user->id)->first();
        $tumbuhanbawah = TumbuhanBawah::where('polt-area_id', $user->id)->first();
        $pohon = Pohon::where('polt-area_id', $user->id)->first();
        $pancang = Pancang::where('polt-area_id', $user->id)->first();
        $tiang = Tiang::where('polt-area_id', $user->id)->first();
        $nekromas = Necromass::where('polt-area_id', $user->id)->first();
        // dd($user, $profil, $poltArea);
        return view('percobaan', compact('user', 'poltArea', 'serasah', 'semai', 'pancang', 'tiang', 'nekromas', 'pohon', 'tanah'));
    });
    Route::get('/PlotArea', [PoltAreaController::class, 'index'])->name('PlotArea.index');
    Route::post('/plotarea/store', [PoltAreaController::class, 'store'])->name('plotarea.store');

    // Route::post('/Serasah/store', [SerasahController::class, 'store'])->name('Serasah.store');

    Route::controller(zonaController::class)->group(function () {
        Route::get("/zona", "index")->name('zona.index');
    });;
    Route::controller(SerasahController::class)->group(function () {
        Route::post("/PlotA/store", "store")->name('Serasah.store');
        Route::get("/PlotA", "index")->name('PlotA.index');
        Route::post("/PlotA/update/{id}", "update");
        Route::delete("/PlotA/{id}", "destroy");
    });;

    Route::controller(SemaiController::class)->group(function () {
        Route::post("/Semai/store", "store")->name('Semai.store');
        Route::get("/Semai", "index");
        Route::post("/Semai/update/{id}", "update");
        Route::delete("/Semai/{id}", "destroy");
    });
    Route::controller(TunmbuhanBawahController::class)->group(function () {
        Route::post("/Tumbuhanbawah/store", "store")->name('tumbuhanBawah.store');
        Route::get("/Tumbuhanbawah", "index");
        Route::post("/Tumbuhanbawah/update/{id}", "update");
        Route::delete("/Tumbuhanbawah/{id}", "destroy");
    });
    Route::controller(TanahController::class)->group(function () {
        Route::post("/Tanah/store", "store")->name('tanah.store');
        Route::get("/Tanah", "index");
        Route::post("/Tanah/update/{id}", "update");
        Route::delete("/Tanah/{id}", "destroy");
    });

    Route::controller(PancangContrller::class)->group(function () {
        Route::post("/PlotB/store", "store")->name('pancang.store');
        Route::get("/PlotB", "index")->name('PlotB.index');
        Route::post("/PlotB/update/{id}", "update");
        Route::delete("/PlotB/{id}", "destroy");
    });

    Route::controller(NekromasController::class)->group(function () {
        Route::post("/Nekromass/store", "store")->name('nekromas.store');
        Route::get("/Nekromass", "index");
        Route::post("/Nekromass/update/{id}", "update");
        Route::delete("/Nekromass/{id}", "destroy");
    });
    Route::controller(TiangController::class)->group(function () {
        Route::post("/Tiang/buat", "store")->name('tiang.store');
        Route::get("/PlotC", "index")->name('PlotC.index');
        Route::post("/Tiang/update/{id}", "update");
        Route::delete("/Tiang/{id}", "destroy");
    });
    Route::controller(PohonController::class)->group(function () {
        Route::post("/Pohon/buat", "store")->name('pohon.store');
        Route::get("/PlotD", "index")->name('PlotD.index');
        Route::post("/Pohon/update/{id}", "update");
        Route::delete("/Pohon/{id}", "destroy");
    });
    Route::controller(RingkasanController::class)->group(function () {
        Route::get("/hitung", 'index')->name('hitung.index');
        Route::get("/ringkasan", 'indexx')->name('ringkasan.indexx');
    });
    Route::controller(PeriodeController::class)->group(function () {
        Route::get('/Manajemen-Tim', 'index')->name('Manajemen-Tim.index');
    });
    Route::controller(SUrveyorController::class)->group(function () {
        Route::get('/Surveyor/Tambah-Surveyor', 'indexx')->name('Tambah-Surveyor.indexx');
    });
    Route::get('/profile', [ProfilController::class, 'index'])->name('profile.index');
    // Route::post('/profile/{id}', [ProfilController::class, 'store'])->name('profile.store');
    Route::get('/profile/{slug}', [ProfilController::class, 'show'])->name('profile.show');
    Route::put('/profile/{slug}', [ProfilController::class, 'update'])->name('profile.update');


    Route::controller(PanduanController::class)->group(function () {
        Route::get('/panduan', 'index')->name('panduan.index');
    });
    Route::controller(DataPlotController::class)->group(function () {
        Route::get('/dataPlot', 'index')->name('dataPlot.index');
        Route::get('/Lokasi', 'lokasi')->name('Lokasi.lokasi');
    });
    Route::controller(ManajermenUserController::class)->group(function () {
        Route::get('/Verifikasi', 'index')->name('Verifikasi.index');
    });
    Route::controller(SampahController::class)->group(function () {
        Route::get('/Sampah', 'index')->name('Sampah.index');
    });
    Route::controller(HamparanController::class)->group(function () {
        Route::get('/Hamparan', 'index')->name('Hamparan.index');
    });
});
