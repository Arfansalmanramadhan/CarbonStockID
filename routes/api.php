<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PoltAreaController;
use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\PancangContrller;
use App\Http\Controllers\SemaiController;
use App\Http\Controllers\SerasahController;
use App\Http\Controllers\TanahController;
use App\Http\Controllers\TiangController;
use App\Http\Controllers\TunmbuhanBawahController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(AuthController::class)->group(function () {
    Route::post("/registasi", "registasi");
    Route::post("/login", "login");
    Route::post("/loginn", "login");
    Route::post("/forgotPassword", "forgotPassword");
    Route::post("/resetPassword", "resetPassword");
});
Route::middleware("auth:sanctum")->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post("/logout", "logout");
        Route::get("/getUser", "getUser");
    });
    Route::controller(ProfilController::class)->group(function () {
        Route::get("/profil", "index");
        Route::post("/profil/buat", "store");
        Route::get("/profil/show/{id}", "show");
        Route::get("/profil/edit/{id}", "edit");
        Route::post("/profil/update/{id}", "update");
    });
    Route::controller(PoltAreaController::class)->group(function () {
        Route::get("/polt-area", "index");
        Route::post("/polt-area/buat", "store");
        Route::get("/polt-area/{slug}", "show");
        Route::post("/polt-area/{slug}", "update");
        Route::delete("/polt-area/{slug}", "destroy");
        Route::post("/polt-area/restore/{slug}", "restore");
        Route::delete("/polt-area/force-delete/{slug}", "forceDelete");
    });
    Route::controller(SerasahController::class)->group(function () {
        Route::post("/Serasah/buat", "store");
        Route::get("/Serasah", "index");
        Route::post("/Serasah/update/{id}", "update");
        Route::delete("/Serasah/{id}", "destroy");
    });
    Route::controller(SemaiController::class)->group(function () {
        Route::post("/Semai/buat", "store");
        Route::get("/Semai", "index");
        Route::post("/Semai/update/{id}", "update");
        Route::delete("/Semai/{id}", "destroy");
    });
    Route::controller(TunmbuhanBawahController::class)->group(function () {
        Route::post("/Tumbuhanbawah/buat", "store");
        Route::get("/Tumbuhanbawah", "index");
        Route::post("/Tumbuhanbawah/update/{id}", "update");
        Route::delete("/Tumbuhanbawah/{id}", "destroy");
    });
    Route::controller(TanahController::class)->group(function () {
        Route::post("/Tanah/buat", "store");
        Route::get("/Tanah", "index");
        Route::post("/Tanah/update/{id}", "update");
        Route::delete("/Tanah/{id}", "destroy");
    });
    Route::controller(PancangContrller::class)->group(function () {
        Route::post("/Pancang/buat", "store");
        Route::get("/Pancang", "index");
        Route::post("/Pancang/update/{id}", "update");
        Route::delete("/Pancang/{id}", "destroy");
    });
    Route::controller(TiangController::class)->group(function () {
        Route::post("/Tiang/buat", "store");
        Route::get("/Tiang", "index");
        Route::post("/Tiang/update/{id}", "update");
        Route::delete("/Tiang/{id}", "destroy");
    });
});
