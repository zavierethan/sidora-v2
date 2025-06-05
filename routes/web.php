<?php

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

Route::get('/', [App\Http\Controllers\WebController::class, 'index'])->name('index');
Route::get('/infrastruktur-keolahragaan', [App\Http\Controllers\WebController::class, 'infografis'])->name('infografis');
Route::get('/olahraga-prestasi', [App\Http\Controllers\WebController::class, 'olahragaPrestasi'])->name('olahraga.prestasi');
Route::get('/olahraga-masyarakat', [App\Http\Controllers\WebController::class, 'olahragaMasyarakat'])->name('olahraga.masyarakat');
Route::get('/kegiatan', [App\Http\Controllers\WebController::class, 'kegiatan'])->name('kegiatan');
Route::get('/galeri', [App\Http\Controllers\WebController::class, 'galeri'])->name('galeri');

Route::post('/register/save', [App\Http\Controllers\RegistrationController::class, 'save'])->name('transaksi.registration.save');
Route::get('/register/confirmation', [App\Http\Controllers\RegistrationController::class, 'save'])->name('transaksi.registration.confirmation');


Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('master')->group(function () {

        Route::prefix('kecamatan')->group(function () {
            Route::get('/', [App\Http\Controllers\KecamatanController::class, 'index'])->name('master.kecamatan.index');
            Route::get('/get-lists', [App\Http\Controllers\KecamatanController::class, 'getLists'])->name('master.kecamatan.get-lists');
            Route::post('/save', [App\Http\Controllers\KecamatanController::class, 'save'])->name('master.kecamatan.save');
            Route::get('/edit/{id}', [App\Http\Controllers\KecamatanController::class, 'edit'])->name('master.kecamatan.edit');
            Route::post('/update', [App\Http\Controllers\KecamatanController::class, 'update'])->name('master.kecamatan.update');
        });

        Route::prefix('desa-kelurahan')->group(function () {
            Route::get('/', [App\Http\Controllers\DesaKelurahanController::class, 'index'])->name('master.desa-kelurahan.index');
            Route::get('/get-lists', [App\Http\Controllers\DesaKelurahanController::class, 'getLists'])->name('master.desa-kelurahan.get-lists');
            Route::post('/save', [App\Http\Controllers\DesaKelurahanController::class, 'save'])->name('master.desa-kelurahan.save');
            Route::get('/edit/{id}', [App\Http\Controllers\DesaKelurahanController::class, 'edit'])->name('master.desa-kelurahan.edit');
            Route::post('/update', [App\Http\Controllers\DesaKelurahanController::class, 'update'])->name('master.desa-kelurahan.update');

            Route::get('/by-kecamatan/{kecamatan_id}', [App\Http\Controllers\DesaKelurahanController::class, 'getDataDesKelByKecamatanId']);
        });

        Route::prefix('sarana')->group(function () {
            Route::get('/', [App\Http\Controllers\SaranaController::class, 'index'])->name('master.sarana.index');
            Route::get('/get-lists', [App\Http\Controllers\SaranaController::class, 'getLists'])->name('master.sarana.get-lists');
            Route::post('/save', [App\Http\Controllers\SaranaController::class, 'save'])->name('master.sarana.save');
            Route::get('/edit/{id}', [App\Http\Controllers\SaranaController::class, 'edit'])->name('master.sarana.edit');
            Route::post('/update', [App\Http\Controllers\SaranaController::class, 'update'])->name('master.sarana.update');
            Route::get('/delete/{id}', [App\Http\Controllers\SaranaController::class, 'delete'])->name('master.sarana.delete');
        });

        Route::prefix('prasarana')->group(function () {
            Route::get('/', [App\Http\Controllers\PrasaranaController::class, 'index'])->name('master.prasarana.index');
            Route::get('/get-lists', [App\Http\Controllers\PrasaranaController::class, 'getLists'])->name('master.prasarana.get-lists');
            Route::post('/save', [App\Http\Controllers\PrasaranaController::class, 'save'])->name('master.prasarana.save');
            Route::get('/edit/{id}', [App\Http\Controllers\PrasaranaController::class, 'edit'])->name('master.prasarana.edit');
            Route::post('/update', [App\Http\Controllers\PrasaranaController::class, 'update'])->name('master.prasarana.update');
            Route::get('/delete/{id}', [App\Http\Controllers\PrasaranaController::class, 'delete'])->name('master.prasarana.delete');
        });

        Route::prefix('cabang-olahraga')->group(function () {
            Route::get('/', [App\Http\Controllers\CabangOlahragaController::class, 'index'])->name('master.cabang-olahraga.index');
            Route::get('/get-lists', [App\Http\Controllers\CabangOlahragaController::class, 'getLists'])->name('master.cabang-olahraga.get-lists');
            Route::post('/save', [App\Http\Controllers\CabangOlahragaController::class, 'save'])->name('master.cabang-olahraga.save');
            Route::get('/edit/{id}', [App\Http\Controllers\CabangOlahragaController::class, 'edit'])->name('master.cabang-olahraga.edit');
            Route::post('/update', [App\Http\Controllers\CabangOlahragaController::class, 'update'])->name('master.cabang-olahraga.update');
            Route::get('/delete/{id}', [App\Http\Controllers\CabangOlahragaController::class, 'delete'])->name('master.cabang-olahraga.delete');
        });

        Route::prefix('induk-olahraga')->group(function () {
            Route::get('/', [App\Http\Controllers\IndukOlahragaController::class, 'index'])->name('master.induk-olahraga.index');
            Route::get('/get-lists', [App\Http\Controllers\IndukOlahragaController::class, 'getLists'])->name('master.induk-olahraga.get-lists');
            Route::post('/save', [App\Http\Controllers\IndukOlahragaController::class, 'save'])->name('master.induk-olahraga.save');
            Route::get('/edit/{id}', [App\Http\Controllers\IndukOlahragaController::class, 'edit'])->name('master.induk-olahraga.edit');
            Route::post('/update', [App\Http\Controllers\IndukOlahragaController::class, 'update'])->name('master.induk-olahraga.update');
            Route::get('/delete/{id}', [App\Http\Controllers\IndukOlahragaController::class, 'delete'])->name('master.induk-olahraga.delete');
        });
    });

    Route::prefix('kegiatan')->group(function () {
        Route::prefix('galeri')->group(function () {
            Route::get('/', [App\Http\Controllers\GaleriController::class, 'index'])->name('kegiatan.galeri.index');
            Route::get('/get-lists', [App\Http\Controllers\GaleriController::class, 'getLists'])->name('kegiatan.galeri.get-lists');
            Route::get('/create', [App\Http\Controllers\GaleriController::class, 'create'])->name('kegiatan.galeri.create');
            Route::post('/save', [App\Http\Controllers\GaleriController::class, 'save'])->name('kegiatan.galeri.save');
            Route::get('/edit/{id}', [App\Http\Controllers\GaleriController::class, 'edit'])->name('kegiatan.galeri.edit');
            Route::post('/update', [App\Http\Controllers\GaleriController::class, 'update'])->name('kegiatan.galeri.update');
            Route::get('/delete/{id}', [App\Http\Controllers\GaleriController::class, 'delete'])->name('kegiatan.galeri.delete');
        });
    });

    Route::prefix('transaksi')->group(function () {

        Route::prefix('post')->group(function () {
            Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('transaksi.post.index');
            Route::get('/create', [App\Http\Controllers\PostController::class, 'index'])->name('transaksi.post.create');
            Route::post('/save', [App\Http\Controllers\PostController::class, 'save'])->name('transaksi.post.save');
            Route::get('/edit/{id}', [App\Http\Controllers\PostController::class, 'edit'])->name('transaksi.post.edit');
            Route::post('/update', [App\Http\Controllers\PostController::class, 'update'])->name('transaksi.post.update');
        });

        Route::prefix('keolahragaan')->group(function () {

            Route::prefix('forms')->group(function () {
                Route::get('/sarana', [App\Http\Controllers\KeolahragaanFormController::class, 'formSarana'])->name('transaksi.keolahragaan.forms.sarana');
                Route::get('/prasarana', [App\Http\Controllers\KeolahragaanFormController::class, 'formPrasarana'])->name('transaksi.keolahragaan.forms.prasarana');
                Route::get('/kegiatan-olahraga', [App\Http\Controllers\KeolahragaanFormController::class, 'formKegiatanOlahraga'])->name('transaksi.keolahragaan.forms.kegiatan-olahraga');
                Route::get('/prestasi-olahraga', [App\Http\Controllers\KeolahragaanFormController::class, 'formPrestasiOlahraga'])->name('transaksi.keolahragaan.forms.prestasi-olahraga');
                Route::get('/verifikasi-konfirmasi', [App\Http\Controllers\KeolahragaanFormController::class, 'formVerifikasiKonfirmasi'])->name('transaksi.keolahragaan.forms.verifikasi-konfirmasi');
            });

            Route::get('/', [App\Http\Controllers\KeolahragaanController::class, 'index'])->name('transaksi.keolahragaan.index');
            Route::get('/get-lists', [App\Http\Controllers\KeolahragaanController::class, 'getLists'])->name('transaksi.keolahragaan.get-lists');
            Route::post('/create', [App\Http\Controllers\KeolahragaanController::class, 'create'])->name('transaksi.keolahragaan.create');
            Route::post('/save', [App\Http\Controllers\KeolahragaanController::class, 'save'])->name('transaksi.keolahragaan.save');
            Route::get('/detail/{id}', [App\Http\Controllers\KeolahragaanController::class, 'detail'])->name('transaksi.keolahragaan.detail');
            Route::post('/update', [App\Http\Controllers\KeolahragaanController::class, 'update'])->name('transaksi.keolahragaan.update');
            Route::get('/export/{id}', [App\Http\Controllers\KeolahragaanController::class, 'export'])->name('transaksi.keolahragaan.export');

            Route::get('/sarana/get-lists', [App\Http\Controllers\KeolahragaanController::class, 'saranaGetLists'])->name('transaksi.keolahragaan.sarana.get-lists');
            Route::get('/prasarana/get-lists', [App\Http\Controllers\KeolahragaanController::class, 'prasaranaGetLists'])->name('transaksi.keolahragaan.prasarana.get-lists');
            Route::get('/kegiatan-olahraga/get-lists', [App\Http\Controllers\KeolahragaanController::class, 'kegiatanOlahragaGetLists'])->name('transaksi.keolahragaan.kegiatan-olahraga.get-lists');

            Route::post('/sarana/save', [App\Http\Controllers\KeolahragaanController::class, 'saveSarana'])->name('transaksi.keolahragaan.sarana.save');
            Route::post('/prasarana/save', [App\Http\Controllers\KeolahragaanController::class, 'savePrasarana'])->name('transaksi.keolahragaan.prasarana.save');
            Route::post('/kegiatan-olahraga/save', [App\Http\Controllers\KeolahragaanController::class, 'saveKegiatanOlahraga'])->name('transaksi.keolahragaan.kegiatan-olahraga.save');
            Route::post('/prestasi-olahraga/save', [App\Http\Controllers\KeolahragaanController::class, 'savePrestasiOlahraga'])->name('transaksi.keolahragaan.prestasi-olahraga.save');

            Route::get('/sarana/delete/{id}', [App\Http\Controllers\KeolahragaanController::class, 'deleteSarana'])->name('transaksi.keolahragaan.sarana.delete');
            Route::get('/prasarana/delete/{id}', [App\Http\Controllers\KeolahragaanController::class, 'deletePrasarana'])->name('transaksi.keolahragaan.prasarana.delete');
            Route::get('/kegiatan-olahraga/delete/{id}', [App\Http\Controllers\KeolahragaanController::class, 'deleteKegiatanOlahraga'])->name('transaksi.keolahragaan.kegiatan-olahraga.delete');
            Route::get('/prestasi-olahraga/delete/{id}', [App\Http\Controllers\KeolahragaanController::class, 'deletePrestasiOlahraga'])->name('transaksi.keolahragaan.prestasi-olahraga.delete');

            Route::post('/sarana/update', [App\Http\Controllers\KeolahragaanController::class, 'updateSarana'])->name('transaksi.keolahragaan.sarana.update');
            Route::post('/prasarana/update', [App\Http\Controllers\KeolahragaanController::class, 'updatePrasarana'])->name('transaksi.keolahragaan.prasarana.update');
            Route::post('/kegiatan-olahraga/update', [App\Http\Controllers\KeolahragaanController::class, 'updateKegiatanOlahraga'])->name('transaksi.keolahragaan.kegiatan-olahraga.update');

            Route::post('/get-image-by-sarana-id', [App\Http\Controllers\KeolahragaanController::class, 'getImageBySaranaId'])->name('transaksi.get.image.by.sarana.id');
            Route::post('/get-sarana-by-id', [App\Http\Controllers\KeolahragaanController::class, 'getSaranaById'])->name('transaksi.get.sarana.id');
            Route::post('/get-prasarana-by-id', [App\Http\Controllers\KeolahragaanController::class, 'getPrasaranaById'])->name('transaksi.get.prasarana.id');
            Route::post('/get-kegiatan-olahraga-by-id', [App\Http\Controllers\KeolahragaanController::class, 'getKegiatanOlahragaById'])->name('transaksi.get.kegiatan.olahraga.by.id');
        });

        Route::prefix('olahraga-prestasi')->group(function () {
            Route::get('/', [App\Http\Controllers\OlahragaPrestasiController::class, 'index'])->name('transaksi.olahraga-prestasi.index');
            Route::match(['get', 'post'], '/get-lists', [App\Http\Controllers\OlahragaPrestasiController::class, 'getLists'])->name('transaksi.olahraga-prestasi.get-lists');
            Route::post('/save', [App\Http\Controllers\OlahragaPrestasiController::class, 'save'])->name('transaksi.olahraga-prestasi.save');
            Route::get('/create', [App\Http\Controllers\OlahragaPrestasiController::class, 'create'])->name('transaksi.olahraga-prestasi.create');
            Route::get('/detail/{id}', [App\Http\Controllers\OlahragaPrestasiController::class, 'detail'])->name('transaksi.olahraga-prestasi.detail');
            Route::post('/update', [App\Http\Controllers\OlahragaPrestasiController::class, 'update'])->name('transaksi.olahraga-prestasi.update');
            Route::post('/detail/save', [App\Http\Controllers\OlahragaPrestasiController::class, 'saveDetail'])->name('transaksi.olahraga-prestasi.detail.save');
            Route::get('/detail/delete/{id}', [App\Http\Controllers\OlahragaPrestasiController::class, 'deleteDetail'])->name('transaksi.olahraga-prestasi.detail.delete');
            Route::get('/delete/{keolahragaanId}/{id}', [App\Http\Controllers\OlahragaPrestasiController::class, 'delete'])->name('transaksi.olahraga-prestasi.delete');

            Route::post('/detail/prestasi', [App\Http\Controllers\OlahragaPrestasiController::class, 'getPrestasiById'])->name('transaksi.olahraga-prestasi.get-prestasi');
            Route::post('/detail/lisensi', [App\Http\Controllers\OlahragaPrestasiController::class, 'getLisensiById'])->name('transaksi.olahraga-prestasi.get-lisensi');

            Route::post('/detail/prestasi/update', [App\Http\Controllers\OlahragaPrestasiController::class, 'updatePrestasi'])->name('transaksi.olahraga-prestasi.detail.update-prestasi');
            Route::post('/detail/lisensi/update', [App\Http\Controllers\OlahragaPrestasiController::class, 'updateLisensi'])->name('transaksi.olahraga-prestasi.detail.update-lisensi');

            Route::get('/export', [App\Http\Controllers\OlahragaPrestasiController::class, 'export'])->name('transaksi.olahraga-prestasi.export');
            Route::post('/upload-foto', [App\Http\Controllers\OlahragaPrestasiController::class, 'uploadFoto'])->name('transaksi.olahraga-prestasi.upload-foto');
        });

        Route::prefix('olahraga-masyarakat')->group(function () {
            Route::get('/', [App\Http\Controllers\OlahragaMasyarakatController::class, 'index'])->name('transaksi.olahraga-masyarakat.index');
            Route::get('/get-lists', [App\Http\Controllers\OlahragaMasyarakatController::class, 'getLists'])->name('transaksi.olahraga-masyarakat.get-lists');
            Route::post('/save', [App\Http\Controllers\OlahragaMasyarakatController::class, 'save'])->name('transaksi.olahraga-masyarakat.save');
            Route::get('/create', [App\Http\Controllers\OlahragaMasyarakatController::class, 'create'])->name('transaksi.olahraga-masyarakat.create');
            Route::get('/detail/{id}', [App\Http\Controllers\OlahragaMasyarakatController::class, 'detail'])->name('transaksi.olahraga-masyarakat.detail');
            Route::post('/update', [App\Http\Controllers\OlahragaMasyarakatController::class, 'update'])->name('transaksi.olahraga-masyarakat.update');
            Route::post('/detail/save', [App\Http\Controllers\OlahragaMasyarakatController::class, 'saveDetail'])->name('transaksi.olahraga-masyarakat.detail.save');
            Route::post('/detail/delete/{id}', [App\Http\Controllers\OlahragaMasyarakatController::class, 'deleteDetail'])->name('transaksi.olahraga-masyarakat.detail.delete');
            Route::get('/delete/{keolahragaanId}/{id}', [App\Http\Controllers\OlahragaMasyarakatController::class, 'delete'])->name('transaksi.olahraga-masyarakat.delete');

            Route::get('/export', [App\Http\Controllers\OlahragaMasyarakatController::class, 'export'])->name('transaksi.olahraga-masyarakat.export');
            Route::post('/upload-foto', [App\Http\Controllers\OlahragaMasyarakatController::class, 'uploadFoto'])->name('transaksi.olahraga-masyarakat.upload-foto');
        });

        Route::prefix('pengaturan')->group(function () {

            Route::prefix('registartions')->group(function () {
                Route::get('/', [App\Http\Controllers\RegistrationController::class, 'index'])->name('transaksi.pengaturan.registration.index');
                Route::get('/get-lists', [App\Http\Controllers\RegistrationController::class, 'getLists'])->name('transaksi.pengaturan.registration.get-lists');
                Route::post('/save', [App\Http\Controllers\RegistrationController::class, 'save'])->name('transaksi.pengaturan.registration.save');
                Route::get('/edit/{id}', [App\Http\Controllers\RegistrationController::class, 'edit'])->name('transaksi.pengaturan.registration.edit');
                Route::post('/update', [App\Http\Controllers\RegistrationController::class, 'update'])->name('transaksi.pengaturan.registration.update');
                Route::get('/approve/{id}', [App\Http\Controllers\RegistrationController::class, 'approve'])->name('transaksi.pengaturan.registration.approve');
            });

            Route::prefix('users')->group(function () {
                Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('transaksi.pengaturan.user.index');
                Route::get('/get-lists', [App\Http\Controllers\UserController::class, 'getLists'])->name('transaksi.pengaturan.user.get-lists');
                Route::post('/save', [App\Http\Controllers\UserController::class, 'save'])->name('transaksi.pengaturan.user.save');
                Route::get('/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('transaksi.pengaturan.user.edit');
                Route::post('/update', [App\Http\Controllers\UserController::class, 'update'])->name('transaksi.pengaturan.user.update');

                Route::get('/reset-password', [App\Http\Controllers\UserController::class, 'resetPassword'])->name('transaksi.pengaturan.user.reset-password');
                Route::post('/update-password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('transaksi.pengaturan.user.update-password');
            });

            Route::prefix('roles')->group(function () {
                Route::get('/', [App\Http\Controllers\RoleController::class, 'index'])->name('transaksi.pengaturan.role.index');
                Route::get('/get-lists', [App\Http\Controllers\RoleController::class, 'getLists'])->name('transaksi.pengaturan.role.get-lists');
                Route::post('/save', [App\Http\Controllers\RoleController::class, 'save'])->name('transaksi.pengaturan.role.save');
                Route::get('/edit/{id}', [App\Http\Controllers\RoleController::class, 'edit'])->name('transaksi.pengaturan.role.edit');
                Route::post('/update', [App\Http\Controllers\RoleController::class, 'update'])->name('transaksi.pengaturan.role.update');
            });
        });
    });
});
