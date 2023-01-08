<?php

use App\Http\Controllers\API\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\DokterController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/dashboard/dokter/index', [DokterController::class, 'indexDokter'])->name('index.dokter');
Route::get('/dashboard/dokter/detail/{id}', [DokterController::class, 'detailDokter'])->name('detail.dokter');
Route::post('/dashboard/create/dokter', [DokterController::class, 'createDokter'])->name('create.dokter');
Route::get('/dashboard/delete/dokter/{id}', [DokterController::class, 'deleteDokter'])->name('delete.dokter');
Route::post('/dokter/dashboard/update/{id}', [DokterController::class, 'updateDokter'])->name('update.dokter');

Route::get('/dashboard/transaksi/index', [TransactionsController::class, 'indexTransaksi'])->name('index.transaksi');
Route::get('/dashboard/transaksi/detail/{id}', [TransactionsController::class, 'detailTransaksi'])->name('detail.transaksi');
Route::post('/transaksi/dashboard/update/{id}', [TransactionsController::class, 'updateTransaction'])->name('update.transaksi');

// Midtrans related
Route::get('midtrans/success', [TransactionController::class, 'success']);
Route::get('midtrans/unfinish', [TransactionController::class, 'unfinish']);
Route::get('midtrans/error', [TransactionController::class, 'error']);