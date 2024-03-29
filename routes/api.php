<?php

use App\Http\Controllers\Api\CollectionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransactionController;

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

Route::post('/transaction', [TransactionController::class, 'store'])->name('transaction.store');
Route::put('/collection/rqsttopay/{id_generate}', [CollectionController ::class, 'rqsttopay'])->name('collection.rqstopay');
Route::get('/collection/paymentstatus/{id_generate}', [CollectionController ::class, 'paymentStatus'])->name('collection.paymentStatus');