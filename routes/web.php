<?php

use App\Models\Pohon;
use App\Models\Semai;
use App\Models\Tanah;
use App\Models\Tiang;
use App\Models\Pancang;
use App\Models\Profil;
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
use App\Http\Controllers\Authentication\AuthController;

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
Route::get('/login', [AuthController::class, 'index'])->name('login');

// Rute untuk proses login
Route::post('/login', [AuthController::class, 'login']);


// Route::get('/login', function () {
//     return view('login');
// });

// Rute untuk halaman register
Route::get('/register', function () {
    return view('register');
})->name('register');

// Rute untuk proses registrasi
Route::post('/register', [AuthController::class, 'registasi'])->name('daftar');

Route::get('/dashboard', function () {
    $user = Auth::user();
    $profil = Profil::where('id', $user->id)->first();
    $poltArea = PoltArea::where('profil_id', $profil->id)->first();
    // $plotAreas = PlotArea::where('profil_id', $profil->id)->get();
    return view('dashboard', compact('user', 'profil', 'poltArea')); // Kirim $profil ke view
})->name('dashboard');

Route::get('/profile', [ProfilController::class, 'index'])->name('profile');
// Route::post('/profile/{id}', [ProfilController::class, 'store'])->name('profile.store');
Route::put('/profile/{id}', [ProfilController::class, 'update'])->name('profile.update');
Route::get('/profile/{id}', [ProfilController::class, 'show'])->name('profile.show');


// Route untuk halaman tambah data
Route::get('/tambahData', function () {
    $user = Auth::user();
    $profil = Profil::where('id', $user->id)->first();
    $poltArea = PoltArea::where('profil_id', $profil->id)->first();
    $serasah = Serasah::where('polt-area_id', $poltArea->id)->first();
    $semai = Semai::where('polt-area_id', $poltArea->id)->first();
    $tanah = Tanah::where('polt-area_id', $poltArea->id)->first();
    $tumbuhanbawah = TumbuhanBawah::where('polt-area_id', $poltArea->id)->first();
    $pohon = Pohon::where('polt-area_id', $poltArea->id)->first();
    $pancang = Pancang::where('polt-area_id', $poltArea->id)->first();
    $tiang = Tiang::where('polt-area_id', $poltArea->id)->first();
    $nekromas = Necromass::where('polt-area_id', $poltArea->id)->first();
    // dd($user, $profil, $poltArea);   
    return view('tambahData', compact('user', 'profil', 'poltArea', 'serasah', 'semai', 'tanah', 'pancang', 'tiang', 'nekromas', 'pohon', 'tumbuhanbawah'));
});

Route::get('/percobaan', function () {
    $user = Auth::user();
    $profil = Profil::where('id', $user->id)->first();
    $poltArea = PoltArea::where('profil_id', $profil->id)->first();
    $serasah = Serasah::where('polt-area_id', $poltArea->id)->first();
    $semai = Semai::where('polt-area_id', $poltArea->id)->first();
    $tanah = Tanah::where('polt-area_id', $poltArea->id)->first();
    $tumbuhanbawah = TumbuhanBawah::where('polt-area_id', $poltArea->id)->first();
    $pohon = Pohon::where('polt-area_id', $poltArea->id)->first();
    $pancang = Pancang::where('polt-area_id', $poltArea->id)->first();
    $tiang = Tiang::where('polt-area_id', $poltArea->id)->first();
    $nekromas = Necromass::where('polt-area_id', $poltArea->id)->first();
    // dd($user, $profil, $poltArea);   
    return view('percobaan', compact('user', 'profil', 'poltArea', 'serasah', 'semai', 'pancang', 'tiang', 'nekromas', 'pohon', 'tanah'));
});

Route::post('/plotarea/store', [PoltAreaController::class, 'store'])->name('plotarea.store');

// Route::post('/Serasah/store', [SerasahController::class, 'store'])->name('Serasah.store');

Route::controller(SerasahController::class)->group(function () {
    Route::post("/Serasah/store", "store")->name('Serasah.store');
    Route::get("/Serasah", "index")->name('tambahData.index');
    Route::post("/Serasah/update/{id}", "update");
    Route::delete("/Serasah/{id}", "destroy");
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
    Route::post("/Pancang/store", "store")->name('pancang.store');
    Route::get("/Pancang", "index");
    Route::post("/Pancang/update/{id}", "update");
    Route::delete("/Pancang/{id}", "destroy");
});

Route::controller(NekromasController::class)->group(function () {
    Route::post("/Nekromass/store", "store")->name('nekromas.store');
    Route::get("/Nekromass", "index");
    Route::post("/Nekromass/update/{id}", "update");
    Route::delete("/Nekromass/{id}", "destroy");
});
Route::controller(TiangController::class)->group(function () {
    Route::post("/Tiang/buat", "store")->name('tiang.store');
    Route::get("/Tiang", "index");
    Route::post("/Tiang/update/{id}", "update");
    Route::delete("/Tiang/{id}", "destroy");
});
Route::controller(PohonController::class)->group(function () {
    Route::post("/Pohon/buat", "store")->name('pohon.store');
    Route::get("/Pohon", "index");
    Route::post("/Pohon/update/{id}", "update");
    Route::delete("/Pohon/{id}", "destroy");
});
