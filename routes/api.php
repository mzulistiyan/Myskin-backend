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
    Route::get('get/pasien', [PasienController::class, 'getDataPasien']);
    Route::post('update/pasien', [PasienController::class, 'updatePasien']);
    Route::post('logout', [PasienController::class, 'logoutPasien']);
    Route::post('pasien/change-password', [PasienController::class, 'gantiPassword']);
    Route::post('teskesehatan', [PasienController::class, 'tesKesehatanKulit']);
    Route::get('get/teskesehatan', [PasienController::class, 'getTesKesehatanKulit']);

    //Dokter
    Route::get('get/all/dokter', [DokterController::class, 'getAllDokter']);
    Route::get('get/dokter', [DokterController::class, 'getDokter']);
    Route::post('update/dokter', [DokterController::class, 'updateDokter']);
    Route::post('logout/dokter', [DokterController::class, 'logoutDokter']);
    Route::post('dokter/change-password', [DokterController::class, 'changePasswordDokter']);

    Route::post('checkout', [TransactionController::class, 'checkout']);
    Route::get('transaction', [TransactionController::class, 'getDataAllTransaksi']);
    Route::post('transaction/{id}', [TransactionController::class, 'updateTransaksi']);


    Route::get('consults', [ConsultController::class, 'getConsultasiPasien']);
    Route::get('consults/dokter', [ConsultController::class, 'getConsultasiDokter']);
    Route::get('rekam-medis', [ConsultController::class, 'getRekamMedis']);
    Route::post('consults/update/{id}', [ConsultController::class, 'updateKonsultasi']);
});
Route::post('login', [PasienController::class, 'loginPasien']);
Route::post('register', [PasienController::class, 'registerPasien']);
    
Route::post('midtrans/callback', [TransactionController::class, 'callback']);


//Dokter
Route::post('login/dokter', [DokterController::class, 'loginDokter']);
Route::post('register/dokter', [DokterController::class, 'registerDokter']);
