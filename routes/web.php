<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HariLiburController;
use App\Http\Controllers\LogAbsensiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JamKerjaController;
use App\Http\Controllers\JenisIzinController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PengajuanIzinController;
use App\Models\PengajuanIzin;
use Illuminate\Support\Facades\Auth;


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
    return view('auth.login');
});

Route::get('/home', [HomeController::class, 'index'])->middleware('can:view')->name('home');

Route::get('/pengajuan', [PengajuanIzinController::class, 'index'])->middleware('can:view')->name('pengajuan.index');
   
Route::get('/jam', [JamKerjaController::class, 'index'])->middleware('can:view');

Route::get('/libur', [HariLiburController::class, 'index'])->middleware('can:view');

Route::get('/laporan', [LogAbsensiController::class, 'index'])->middleware('can:view');

Route::get('/karyawan', [KaryawanController::class, 'index'])->middleware('can:view');

Route::resource('karyawan', KaryawanController::class);

Route::post('/karyawan/store', [KaryawanController::class, 'store'])->name('karyawan.store');

Route::put('/karyawan/update/{user_id}', [KaryawanController::class, 'update'])->name('karyawan.update');

Route::delete('/karyawan/delete/{user_id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');

Route::post('/harilibur/store', [HariLiburController::class, 'store'])->name('harilibur.store');

Route::put('/harilibur/update/{id_libur}', [HariLiburController::class, 'update'])->name('harilibur.update');

Route::get('/harilibur/delete/{id_libur}', [HariLiburController::class, 'destroy'])->name('harilibur.delete');

Route::get('dashboard', function() {
})->middleware('role:admin')->name('dashboard');

Route::get('user-page', function() {
})->middleware('role:user')->name('user.page');
// Route untuk autentikasi (login, register, dll.)
Auth::routes();
