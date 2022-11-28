<?php

use App\Http\Controllers\API\ConsultController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DokterController;
use App\Http\Controllers\API\PasienController;
use App\Http\Controllers\API\TransactionController;


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
    Route::post('pasien/change-password', [PasienController::class, 'changePassword']);

    //Dokter
    Route::get('get/all/dokter', [DokterController::class, 'getAllDokter']);
    Route::get('get/dokter', [DokterController::class, 'fetchDokter']);
    Route::post('update/dokter', [DokterController::class, 'updateDokter']);
    Route::post('logout/dokter', [DokterController::class, 'logoutDokter']);
    Route::post('dokter/change-password', [DokterController::class, 'changePasswordDokter']);

    Route::post('checkout', [TransactionController::class, 'checkout']);
    Route::get('transaction', [TransactionController::class, 'all']);
    Route::post('transaction/{id}', [TransactionController::class, 'update']);


    Route::get('consults', [ConsultController::class, 'consultasiPasien']);
    Route::get('consults/dokter', [ConsultController::class, 'consultasiDokter']);
    Route::post('consults/update/{id}', [ConsultController::class, 'update']);

   
   
});
Route::post('login', [PasienController::class, 'login']);
Route::post('register', [PasienController::class, 'register']);
    
Route::post('midtrans/callback', [TransactionController::class, 'callback']);


//Dokter
Route::post('login/dokter', [DokterController::class, 'loginDokter']);
Route::post('register/dokter', [DokterController::class, 'registerDokter']);
