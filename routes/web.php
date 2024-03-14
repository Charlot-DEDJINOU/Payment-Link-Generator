<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\DashboardController;

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

Route::get('/login', [AdminController::class, 'getLogin'])->name('admin.getlogin');
Route::post('/login', [AdminController::class, 'postLogin'])->name('admin.postlogin');
Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/createtransaction', [DashboardController::class, 'getCreateTransaction'])->name('dashboard.getcreatetransaction');
    Route::get('dashboard/transaction/{id_generate}', [DashboardController::class, 'transaction'])->name('dashboard.transaction');
    Route::get('dashboard/refresh/transaction/{id_generate}', [DashboardController::class, 'refreshTransaction'])->name('dashboard.refreshtransaction');
    Route::post('/dashboard/admin', [AdminController::class, 'postRegister'])->name('admin.postregister');
    Route::get('/dashboard/admin', [AdminController::class, 'getRegister'])->name('admin.getregister');
});

Route::get('/{id_generate}', [TransactionController::class, 'index'])->name('transaction.confirm');
Route::put('/{id_generate}', [TransactionController::class, 'checkPayementMethod'])->name('transaction.checkPayementMethod');