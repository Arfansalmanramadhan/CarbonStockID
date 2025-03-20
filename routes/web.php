<?php

use App\Http\Controllers\TambahZonaController;
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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataPlotController;
use App\Http\Controllers\HamparanController;
use App\Http\Controllers\ManajermenUserController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PLotCOntroller;
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

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/dashboard', 'showChart')->name('dashboard');
        // Route::get('/dashboard/showChartPie', 'showChartPie')->name('dashboard.showChartPie');
    });
    // Route::get('/dashboard', function () {
    //     $user = Auth::user();
    //     $poltArea = PoltArea::where('id', $user->id)->first();
    //     return view('dashboard', compact('user',  'poltArea')); // Kirim $profil ke view
    // })->name('dashboard');


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
    // Route::get('/Lokasi/tambah', [PoltAreaController::class, 'index'])->name('Lokasi.index');
    // Route::get('/TambahPlot', [PoltAreaController::class, 'tambah'])->name('TambahPlot.tambah');
    // Route::post('/Lokasi/tambah', [PoltAreaController::class, 'store'])->name('plotarea.store');
    Route::controller(PoltAreaController::class)->group(function () {
        Route::get("/Lokasi/tambah", "index")->name('Lokasi.index');
        Route::post("/Lokasi/tambah", "store")->name('Lokasi.store');
        Route::get("/Lokasi/tambah", "create")->name('Lokasi.index');
        Route::get("/Lokasi/edit/{slug}", "edit")->name('Lokasi.edit');
        Route::put("/Lokasi/edit/{slug}", "update")->name('Lokasi.update');
        Route::get("/TambahPlot", "tambah")->name('TambahPlot.tambah');
    });
    // Route::post('/Serasah/store', [SerasahController::class, 'store'])->name('Serasah.store');



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
        Route::post('/Manajemen-Tim', 'store')->name('Manajemen-Tim.store');
        Route::get('/Manajemen-Tim/anggota/{id}', 'indexx')->name('anggota.indexx');
        Route::post('/Manajemen-Tim/anggota/{id}', 'storee')->name('anggota.storee'); // Perbaiki
        // Route::get('/Manajemen-Tim/anggota/{id}', 'create')->name('anggota.create');
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
    Route::controller(SampahController::class)->group(function () {
        Route::get('/Sampah', 'index')->name('Sampah.index');
    });
    Route::controller(DataPlotController::class)->group(function () {
        Route::get('/dataPlot', 'index')->name('dataPlot.index');
        Route::get('/Lokasi', 'lokasi')->name('Lokasi.lokasi');
    });
    Route::controller(ManajermenUserController::class)->group(function () {
        Route::get('/Verifikasi', 'index')->name('Verifikasi.index');
        Route::get('/Verifikasi', 'view')->name('Verifikasi.index');
        Route::get('/veri/{slug}', 'menyetujui')->name('Verifikasi.menyetujui');

    });
    Route::controller(zonaController::class)->group(function () {
        Route::get("/zona", "index")->name('zona.index');
        // Route::get("/Lokasi/zona/{slug}", "subplot")->name('zona.subplot');
        Route::get("/Lokasi/zona/{slug}", "ringkasan")->name('zona.ringkasan');
        Route::get("/Lokasi/zona/{slug}", "ringkasann")->name('zona.ringkasann');
        Route::get('/Lokasi/zona/{slug}', 'getZona')->name('zona.getZona');
        Route::get("/zona/{slug}/tambah", "tambah")->name('TambahZona.tambah');
        Route::post("/zona/{slug}/tambah", "store")->name('zona.store');
        Route::get("/zona/{slug}/tambah", "create")->name('TambahZona.tambah');
        Route::get("/zona/{slugP}/edit/{slugZ}", "edit")->name('zona.edit');
        Route::put("/zona/{slugP}/edit/{slugZ}", "update")->name('zona.update');
    });
    Route::controller(HamparanController::class)->group(function () {
        Route::get('/Hamparan', 'index')->name('Hamparan.index');
        Route::get('/Zona/hamparan/{id}', 'getHamparan')->name('hamparan.getHamparan');
        Route::get("/Hamparan/{slug}/tambah", "tambah")->name('TambahHamparan.tambah');
        Route::post("/Hamparan/{slug}/tambah", "store")->name('Hamparan.store');
        Route::get("/Hamparan/{slug}/tambah", "create")->name('TambahHamparan.tambah');
        Route::get("/Hamparan/{slugZ}/edit/{slugH}", "edit")->name('Hamparan.edit');
        Route::put("/Hamparan/{slugZ}/edit/{slugH}", "update")->name('Hamparan.update');
    });
    Route::controller(PLotCOntroller::class)->group(function(){
        Route::get('/dataPlot', 'index')->name('dataPlot.index');
        Route::get('/Hamparan/Plot/{id}', 'getPlot')->name('plot.getPlot');
        Route::get('/Plot/SubPlot/{id}', 'getsubPlot')->name('DetailPlot.getsubPlot');
        Route::get('/Plot/{slug}/tambah', 'tambah')->name('Plot.tambah');
        Route::get('/Plot/{slug}/tambah', 'create')->name('Plot.tambah');
        Route::post('/Plot/{slug}/tambah', 'store')->name('Plot.store');
    });
});
