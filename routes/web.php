<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransactionController;

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
Route::get('/register', [AdminController::class, 'getRegister'])->name('admin.getregister');
Route::post('/login', [AdminController::class, 'postLogin'])->name('admin.postlogin');
Route::post('/register', [AdminController::class, 'postRegister'])->name('admin.postregister');
Route::get('/{id_generate}', [TransactionController::class, 'index'])->name('transaction.confirm');
Route::put('/{id_generate}', [TransactionController::class, 'checkPayementMethod'])->name('transaction.checkPayementMethod');