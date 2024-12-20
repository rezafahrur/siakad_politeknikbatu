<?php

use App\Models\ShortenerURL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NilaiMahasiswaController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaKtmController;
use App\Http\Controllers\JadwalImageController;
use App\Http\Controllers\SuratKuisionerController;
use App\Http\Controllers\NilaiController;
use App\Models\SuratKuisioner;

Route::group(['middleware' => ['auth:mahasiswa']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    Route::get('/news', [NewsController::class, 'index'])->name('news');
    Route::get('/biodata', [MahasiswaController::class, 'index'])->name('biodata');
    Route::get('/ktm', [MahasiswaKtmController::class, 'index'])->name('ktm.index');
    Route::post('/ktm', [MahasiswaKtmController::class, 'store'])->name('ktm.store');
    Route::post('/upload-ktm', [MahasiswaKtmController::class, 'uploadKtm'])->name('mahasiswa.ktm.upload');


    Route::get('/krs', [KrsController::class, 'index'])->name('krs');
    Route::get('/jadwal', [JadwalImageController::class, 'index'])->name('jadwal');
    Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai');
    Route::get('/cetak-krs', [KrsController::class, 'cetakPdf'])->name('krs.cetak-pdf');
    Route::get('/lms', function () {
        return view('akademik.lms');
    })->name('lms');
    Route::post('/proxy-update-lms-password', [LoginController::class, 'proxyUpdatePassword']);
    Route::get('/clear-lms-password-session', [LoginController::class, 'clearLmsPasswordSession']);




    Route::get('/permintaan-surat', [SuratKuisionerController::class, 'index'])->name('surat');
    Route::get('/permintaan-surat/create', [SuratKuisionerController::class, 'create'])->name('surat.create');
    Route::post('/permintaan-surat', [SuratKuisionerController::class, 'store'])->name('surat.store');
    Route::get('/riwayat-surat', [SuratKuisionerController::class, 'riwayatSurat'])->name('riwayat-surat');
    //Route::post('/surat-kuisioner/store', [SuratKuisionerController::class, 'store'])->name('surat-kuisioner.store');

    // CRUD Mahasiswa
    // Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    // Route::post('/mahasiswa', [MahasiswaController::class, 'storeOrUpdate'])->name('mahasiswa.store');
    // Route::get('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');
    // Route::get('/mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'storeOrUpdate'])->name('mahasiswa.update');
    // Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

    // ajax
    Route::get('/mahasiswa/cities/{provinceCode}', [MahasiswaController::class, 'getCities']);
    Route::get('/mahasiswa/districts/{cityCode}', [MahasiswaController::class, 'getDistricts']);
    Route::get('/mahasiswa/villages/{districtCode}', [MahasiswaController::class, 'getVillages']);
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/login-process/{hp}/{otp}', [LoginController::class, 'loginProcess'])->name('login.process');
Route::post('/loginFrom', [LoginController::class, 'generateLoginURL'])->name('login.generateURL');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
