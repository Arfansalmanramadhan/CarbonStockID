<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\AuthController;


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

Route::get('/login', [AuthController::class, 'index']);


Route::post('/register', [AuthController::class, 'registasi'])->name('daftar');


Route::post('/login', [AuthController::class, 'login'])->name('login');



Route::get('/register', function () {
    return view('register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/tambahData', function () {
    return view('tambahData');
});



// Route untuk halaman login
Route::get('/login', function () {
    return view('login');
})->name('login');


// Route untuk halaman register
Route::get('/register', function () {
    return view('register');
})->name('register');

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
