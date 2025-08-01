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
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ManajermenUserController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PLotCOntroller;
use App\Http\Controllers\RingkasanController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\SUrveyorController;
use App\Http\Controllers\zonaController;
use App\Models\Role;
use Illuminate\Routing\Route as RoutingRoute;
use App\Http\Controllers\ZonaApiController as ZonaApiController;

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

// Route::get('/', function () {
//     return view('landingPage');
// });
// Route::post('/Serasah/store', [SerasahController::class, 'store'])->name('Serasah.store');
// Route::get('/', [LandingPageController::class, 'index']);
// Route::prefix('zones')->group(function () {
//     Route::get('/', [ZonaApiController::class, 'getAllZones']);
//     Route::get('/{slug}/summary', [ZonaApiController::class, 'getZoneSummary']);
//     Route::get('/polt-area/{poltAreaId}', [ZonaApiController::class, 'getZonesByPoltArea']);
// });
Route::controller(LandingPageController::class)->group(function () {
        Route::get('/', 'index')->name('Galeri.index');
        Route::get('/Galeri', 'create')->name('Galeri.index');
        Route::post('/Galeri', 'store')->name('Galeri.store');
        Route::get('/zones', 'getAllZones')->name('api.zones.all');
        Route::get('/zones/{slug}/summary', 'ringkasann')->name('api.zones.summary');
        Route::get('/zones/plot-area', 'getAllPlotArea')->name('api.zones.allPlotArea');
    });
Route::controller(ZonaApiController::class)->group(function () {
    Route::get('/zones', 'getAllZones')->name('api.zones.all');
    Route::get('/zones/{slug}/summary', 'ringkasann')->name('api.zones.summary');
    Route::get('/zones/plot-area', 'getAllPlotArea')->name('api.zones.allPlotArea');
});


// Rute untuk halaman login
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('only_guest');
    Route::post('/login', 'login')->middleware('only_guest');
    Route::get('/register', 'registasii')->name('register')->middleware('only_guest');
    Route::post('/register', 'registasi')->name('daftar')->middleware('only_guest');
    Route::post('/logout', 'logout')->name('logout')->middleware("auth");
});
Route::middleware('auth')->group(function () {


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
        Route::delete("/Lokasi/{id}", "destroy")->name('Lokasi.destroy');
        Route::get("/TambahPlot", "tambah")->name('TambahPlot.tambah');
    });
    // Route::post('/Serasah/store', [SerasahController::class, 'store'])->name('Serasah.store');

    // Route::controller(LandingPageController::class)->group(function () {
    //     Route::get('/Galeri', 'create')->name('Galeri.index');
    //     Route::post('/Galeri', 'store')->name('Galeri.store');
    //     Route::get('/zones', 'getAllZones')->name('api.zones.all');
    //     Route::get('/zones/{slug}/summary', 'ringkasann')->name('api.zones.summary');
    //     Route::get('/zones/plot-area', 'getAllPlotArea')->name('api.zones.allPlotArea');
    // });

    Route::controller(SerasahController::class)->group(function () {
        Route::get("/Plot/SubPlot/edit/{id}", "edit")->name('edit.edit');
        Route::put("/Plot/SubPlot/serasah/update/{id}", "update")->name('Serasah.update');
        Route::delete("/Plot/SubPlot/Serasah/{id}", "destroy")->name('Serasah.destroy');
    });;

    Route::controller(SemaiController::class)->group(function () {
        Route::post("/Semai/store", "store")->name('Semai.store');
        // Route::get("/Plot/SubPlot/edit/{id}", "edit")->name('edit.edit');
        // Route::get("/PlotA", "index");
        Route::put("/Plot/SubPlot/semai/update/{id}", "update")->name('Semai.update');
        Route::delete("/Plot/SubPlot/Semai/{id}", "destroy")->name('Semai.destroy');
    });
    Route::controller(TunmbuhanBawahController::class)->group(function () {
        Route::post("/Tumbuhanbawah/store", "store")->name('tumbuhanBawah.store');
        // Route::get("/Plot/SubPlot/edit/{id}", "edit")->name('edit.edit');
        Route::get("/Tumbuhanbawah", "index");
        Route::put("/Plot/SubPlot/tumbuhanBawah/update/{id}", "update")->name('tumbuhanBawah.update');
        Route::delete("/Plot/SubPlot/TumbuhanBawah/{id}", "destroy")->name('tumbuhanBawah.destroy');
    });
    Route::controller(TanahController::class)->group(function () {
        Route::get("/Plot/SubPlot/Tanah/Tambah/{id}", "index")->name('tanah.index');
        // Route::get("/Plot/SubPlot/edit/{id}", "edit")->name('edit.edit');
        Route::post("/Plot/SubPlot/Tanah/Tambah/{id}", "store")->name('tanah.store');
        Route::put("/Plot/SubPlot/tanah/update/{id}", "update")->name('tanah.update');
        Route::delete("/Plot/SubPlot/Tanah/{id}", "destroy")->name('tanah.destroy');
    });

    Route::controller(PancangContrller::class)->group(function () {
        Route::post("/PlotB/store", "store")->name('pancang.store');
        Route::get("/PlotB", "index")->name('PlotB.index');
        Route::post("/PlotB/update/{id}", "update");
        // Route::delete("/Plot/SubPlot/{id}", "destroy")->name('pancang.destroy');
        Route::delete("/Plot/SubPlot/Pancang/{id}", "destroy")->name('pancang.destroy');
    });

    Route::controller(NekromasController::class)->group(function () {
        Route::post("/Nekromass/store", "store")->name('nekromas.store');
        Route::get("/Nekromass", "index");
        Route::post("/Nekromass/update/{id}", "update");
        Route::delete("/Plot/SubPlot/Nekromas/{id}", "destroy")->name('nekromas.destroy');
    });
    Route::controller(TiangController::class)->group(function () {
        Route::post("/Tiang/buat", "store")->name('tiang.store');
        Route::get("/PlotC", "index")->name('PlotC.index');
        Route::post("/Tiang/update/{id}", "update");
        Route::delete("/Plot/SubPlot/Tiang/{id}", "destroy")->name('tiang.destroy');
    });
    Route::controller(PohonController::class)->group(function () {
        Route::post("/Pohon/buat", "store")->name('pohon.store');
        Route::get("/PlotD", "index")->name('PlotD.index');
        Route::post("/Pohon/update/{id}", "update");
        Route::delete("/Plot/SubPlot/Pohon/{id}", "destroy")->name('pohon.destroy');
    });

    Route::controller(PeriodeController::class)->group(function () {
        Route::get('/Manajemen-Tim', 'index')->name('Manajemen-Tim.index');
        Route::post('/Manajemen-Tim', 'store')->name('Manajemen-Tim.store');
        Route::get('/Manajemen-Tim/anggota/{id}', 'indexx')->name('anggota.indexx');
        Route::post('/Manajemen-Tim/anggota/{id}', 'storee')->name('anggota.storee'); // Perbaiki
        Route::delete('/Manajemen-Tim/anggota/{id}', 'deleteanggota')->name('anggota.deleteanggota');
        Route::delete('/Manajemen-Tim/{id}', 'deleteTim')->name('Manajemen-Tim.deleteTim');
    });
    Route::controller(SUrveyorController::class)->group(function () {
        Route::get('/Surveyor/Tambah-Surveyor', 'indexx')->name('Tambah-Surveyor.indexx');
        Route::get('/Surveyor', 'surveyor')->name('Surveyor.surveyor');
        Route::get('/Surveyor/edit{slug}', 'show')->name('Surveyor.show');
        Route::put('/Surveyor/edit{slug}', 'update')->name('Surveyor.update');
    });
    Route::get('/profile', [ProfilController::class, 'index'])->name('profile.index');
    // Route::post('/profile/{id}', [ProfilController::class, 'store'])->name('profile.store');
    Route::get('/profile/{slug}', [ProfilController::class, 'show'])->name('profile.show');
    Route::put('/profile/{slug}', [ProfilController::class, 'update'])->name('profile.update');


    Route::controller(PanduanController::class)->group(function () {
        Route::get('/panduan', 'index')->name('panduan.index');
    });
    Route::controller(SampahController::class)->group(function () {
        Route::get('/Jumlah-Pohon', 'index')->name('Sampah.index');
        Route::post('/Jumlah-Pohon', 'hitung')->name('Sampah.hitung');
        Route::get('/Peta', 'peta')->name('peta.peta');
    });
    Route::controller(DataPlotController::class)->group(function () {
        Route::get('/dataPlot', 'index')->name('dataPlot.index');
        Route::get('/Lokasi', 'lokasi')->name('Lokasi.lokasi');
        Route::get('/Lokasi/tim/{id}', 'create')->name('tim.create');
        Route::post('/Lokasi/tim/{id}', 'storee')->name('tim.storee');
    });
    Route::controller(ManajermenUserController::class)->group(function () {
        Route::get('/Verifikasi', 'index')->name('Verifikasi.index');
        Route::get('/Verifikasi', 'view')->name('Verifikasi.index');
        Route::get('/veri/{id}', 'menyetujui')->name('Verifikasi.menyetujui');
    });
    Route::controller(RingkasanController::class)->group(function () {
        Route::get("/Lokasi/zona/hitung/{slug}", 'index')->name('ringkasan.index');
        Route::get("/Lokasi/zona/hitung/dowloan {slug}", "ringkasann")->name('ringkasann.ringkasan');
        Route::get("/Lokasi/zona/hitung/pdf/{slug}", "downloadRingkasan")->name('downloadRingkasan.ringkasan');
        Route::get("/ringkasan", 'indexx')->name('ringkasan.indexx');
    });
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/dashboard', 'showChart')->name('dashboard');
        // Route::get('/dashboard/showChartPie', 'showChartPie')->name('dashboard.showChartPie');
    });
    Route::controller(zonaController::class)->group(function () {
        Route::get("/zona", "index")->name('zona.index');
        // Route::get("/Lokasi/zona/{slug}", "subplot")->name('zona.subplot');
        Route::get("/Lokasi/zona/{slug}", "ringkasan")->name('zona.ringkasan');
        Route::get("/Lokasi/zona/{slug}", "ringkasann")->name('zona.ringkasann');
        Route::get('/Lokasi/zona/{slug}', 'getZona')->name('zona.getZona');
        // Route::get("/zona/{id}/tambah", "tambah")->name('TambahZona.tambah');
        Route::get("/zona/{id}/tambah", "create")->name('TambahZona.tambah');
        Route::post("/zona/{slug}/tambah", "store")->name('zona.store');
        Route::get("/zona/{slugP}/edit/{slugZ}", "edit")->name('zona.edit');
        Route::put("/zona/{slugP}/edit/{slugZ}", "update")->name('zona.update');
        Route::delete("/zona/{id}", "destroy")->name('zona.destroy');
    });
    Route::controller(HamparanController::class)->group(function () {
        Route::get('/Hamparan', 'index')->name('Hamparan.index');
        Route::get('/Zona/hamparan/{id}', 'getHamparan')->name('hamparan.getHamparan');
        Route::get("/Hamparan/{id}/tambah", "tambah")->name('TambahHamparan.tambah');
        Route::post("/Hamparan/{id}/tambah", "store")->name('Hamparan.store');
        Route::get("/Hamparan/{slugZ}/edit/{slugH}", "edit")->name('Hamparan.edit');
        Route::put("/Hamparan/{slugZ}/edit/{slugH}", "update")->name('Hamparan.update');
        Route::delete("/Hamparan/{id}", "destroy")->name('hamparan.destroy');
    });
    Route::controller(PLotCOntroller::class)->group(function () {
        Route::get('/dataPlot', 'index')->name('dataPlot.index');
        Route::get('/Hamparan/Plot/{id}', 'getPlot')->name('plot.getPlot');
        Route::get('/Plot/SubPlot/{id}', 'getsubPlot')->name('DetailPlot.getsubPlot');
        Route::get('/Plot/{slug}/tambah', 'tambah')->name('Plot.tambah');
        Route::get('/Plot/{slug}/tambah', 'create')->name('Plot.tambah');
        Route::post('/Plot/{slug}/tambah', 'store')->name('Plot.store');
        Route::delete("/Plot/{id}", "destroy")->name('plot.destroy');
    });
});
