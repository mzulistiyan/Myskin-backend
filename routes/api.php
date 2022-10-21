<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PasienController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    //Pasiens
    Route::get('get/pasien', [PasienController::class, 'fetchPasien']);
    Route::post('update/pasien', [PasienController::class, 'updateProfile']);
    Route::post('logout', [PasienController::class, 'logout']);

});
Route::post('login', [PasienController::class, 'login']);
Route::post('register', [PasienController::class, 'register']);