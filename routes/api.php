<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::get('/kecamatan', [App\Http\Controllers\API\KecamatanController::class, 'getKecamatan']);
    Route::get('/desa-kelurahan', [App\Http\Controllers\API\KecamatanController::class, 'getDesaKelurahanByKecamatanId']);

    Route::prefix('infrastruktur-olahraga')->group(function () {
        Route::get('/get-total-kecamatan', [App\Http\Controllers\API\InfrastrukturKeolahragaanController::class, 'getTotalKecamatan']);
        Route::get('/get-total-sarana', [App\Http\Controllers\API\InfrastrukturKeolahragaanController::class, 'getTotalSarana']);
        Route::get('/get-total-kelompok-olahraga', [App\Http\Controllers\API\InfrastrukturKeolahragaanController::class, 'getTotalKelompokOlahraga']);
        Route::get('/get-summary-data-kelolahragaan', [App\Http\Controllers\API\InfrastrukturKeolahragaanController::class, 'getSummaryDataKeolahragaanPerKecamatan']);
        Route::get('/get-fasilitas-per-desa-kelurahan-filter-by-kecamatan', [App\Http\Controllers\API\InfrastrukturKeolahragaanController::class, 'getFasilitasPerDesaKelurahanFilterByKecamatan'])->name('get-fasilitas-per-desa-kelurahan-filter-by-kecamatan');
    });

    Route::prefix('olahraga-prestasi')->group(function () {
        Route::get('/get-summary-data-koni', [App\Http\Controllers\API\OlahragaPrestasiController::class, 'getSummaryDataKONI']);
        Route::get('/get-summary-data-npci', [App\Http\Controllers\API\OlahragaPrestasiController::class, 'getSummaryDataNPCI']);
        Route::get('/get-total-summary', [App\Http\Controllers\API\OlahragaPrestasiController::class, 'getSummaryTotalOlahragaPrestasi']);
        Route::get('/get-data-olahraga-prestasi-group-by-desa-kelurahan', [App\Http\Controllers\API\OlahragaPrestasiController::class, 'getDataOlahragaPrestasiGroupByDesaKelurahan'])->name('get-data-olahraga-prestasi-group-by-desa-kelurahan');
    });

    Route::prefix('olahraga-masyarakat')->group(function () {
        Route::get('/get-summary-data-kormi', [App\Http\Controllers\API\OlahragaMasyarakatController::class, 'getSummaryDataKORMI']);
        Route::get('/get-data-olahraga-masyarakat-group-by-desa-kelurahan', [App\Http\Controllers\API\OlahragaMasyarakatController::class, 'getDataOlahragaMasyarkatGroupByDesaKelurahan'])->name('get-data-olahraga-masyarakat-group-by-desa-kelurahan');
    });
});
