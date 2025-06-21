<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PengajuanIzinController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LogAbsensiController;
use Illuminate\Support\Facades\Log;





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


Route::post('/pengajuan-store', [PengajuanIzinController::class, 'store']);

Route::post('login', [LoginController::class, 'login'])->middleware ('api');

Route::get('/karyawan', [KaryawanController::class, 'getKaryawanByEmail']);

Route::put('updatekaryawan/{user_id}', [KaryawanController::class, 'updateKaryawan']);

Route::middleware('auth:sanctum')->get('/log-absensi', [LogAbsensiController::class, 'getAbsensi']);

Route::middleware('auth:sanctum')->get('/pengajuan', [PengajuanIzinController::class, 'getPengajuan']);

Route::middleware('auth:sanctum')->post('/absensimasuk', [LogAbsensiController::class, 'absensiMasuk']);

Route::middleware('auth:sanctum')->post('/absensi-update/pulang', [LogAbsensiController::class, 'absenPulang']);

Route::middleware('auth:sanctum')->post('/absensi-update/istirahat', [LogAbsensiController::class, 'absenIstirahat']);

Route::middleware('auth:sanctum')->post('/absensi-update/istirahat-selesai', [LogAbsensiController::class, 'absenIstirahatSelesai']);


