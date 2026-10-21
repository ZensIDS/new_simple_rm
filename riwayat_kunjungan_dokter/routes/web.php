<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\UserController;
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
    return view('auth.login');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('dokter')->name('dokter.')->group(function () {
        Route::controller(DokterController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'delete')->name('delete');
        });
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'delete')->name('delete');
        });
    });

    Route::prefix('pasien')->name('pasien.')->group(function () {
        Route::controller(PasienController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get-data', 'getData')->name('getData'); // Route baru untuk AJAX
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'delete')->name('delete');
            Route::get('/show/{id}', 'show')->name('show');
        });
    });

    Route::prefix('riwayat')->name('riwayat.')->group(function () {
        Route::controller(RiwayatController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get-data', 'getData')->name('getData');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'delete')->name('delete');
        });
    });

    Route::prefix('report')->name('report.')->group(function () {
        Route::controller(ReportController::class)->group(function () {
            Route::get('/pasien', 'pasien')->name('pasien');
            Route::get('/pasien/get-data', 'getPasienData')->name('pasien.getData'); // Route baru
            Route::get('/pasien/show/{id}', 'showPasien')->name('pasien.show');
            Route::get('/hari', 'hari')->name('hari.index');
            Route::get('/hari/show', 'showHari')->name('hari.show');
        });
    });
});
