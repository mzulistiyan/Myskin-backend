<?php

use App\Http\Controllers\API\TransactionController;
use Illuminate\Support\Facades\Route;

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


// Midtrans related
Route::get('midtrans/success', [TransactionController::class, 'success']);
Route::get('midtrans/unfinish', [TransactionController::class, 'unfinish']);
Route::get('midtrans/error', [TransactionController::class, 'error']);