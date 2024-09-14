<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PoltAreaController;
use App\Http\Controllers\Authentication\AuthController;

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
});
