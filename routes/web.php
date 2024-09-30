<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PoltAreaController;
use App\Http\Controllers\SerasahController;
use App\Http\Controllers\SemaiController;
use App\Http\Controllers\TunmbuhanBawahController;
use App\Http\Controllers\TanahController;
use App\Models\Profil; 
use App\Models\PoltArea;
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
    // dd($user, $profil, $poltArea);   
    return view('tambahData', compact('user', 'profil', 'poltArea'));
});

Route::get('/percobaan', function () {
    return view('percobaan');
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
