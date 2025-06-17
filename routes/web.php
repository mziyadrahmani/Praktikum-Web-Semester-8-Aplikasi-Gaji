<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\LokasiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::resource('pengguna', UserController::class);
    Route::resource('jabatan', JabatanController::class);
    Route::get('get-jabatan', [
        JabatanController::class,
        'getJabatan'
    ])->name('get.jabatan');
    Route::resource('lokasi', LokasiController::class);
    Route::get('get-lokasi', [
        LokasiController::class,
        'getLokasi'
    ])->name('get.lokasi');
});