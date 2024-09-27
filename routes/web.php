<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PoltAreaController;




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
    return view('dashboard');
})->name('dashboard');

Route::get('/profile', [ProfilController::class, 'index'])->name('profile');
// Route::post('/profile/{id}', [ProfilController::class, 'store'])->name('profile.store');
Route::put('/profile/{id}', [ProfilController::class, 'update'])->name('profile.update');
Route::get('/profile/{id}', [ProfilController::class, 'show'])->name('profile.show');


// Route untuk halaman tambah data
Route::get('/tambahData', function () {
    return view('tambahData');
});

Route::get('/percobaan', function () {
    return view('percobaan');
});

Route::post('/plotarea/store', [PoltAreaController::class, 'store'])->name('plotarea.store');



// // Route untuk halaman utama
// Route::get('/', function () {
//     return view('landingPage');
// });

// // Route untuk halaman login
// Route::get('/login', [AuthController::class, 'index'])->name('login');

// // Route untuk halaman register
// Route::get('/register', function () {
//     return view('register');
// })->name('register');

// // Route untuk menangani form register POST
// Route::post('/register', [AuthController::class, 'registasi'])->name('daftar');

// // Route untuk halaman dashboard
// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

// // Route untuk halaman profile
// Route::get('/profile', function () {
//     return view('profile');
// });

// // Route untuk halaman tambah data
// Route::get('/tambahData', function () {
//     return view('tambahData');
// });
