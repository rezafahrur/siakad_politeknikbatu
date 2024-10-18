<?php

use App\Models\ShortenerURL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KuisionerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\KeringananUktController;
use App\Http\Controllers\PembayaranUktController;
use App\Http\Controllers\NilaiMahasiswaController;
use App\Http\Controllers\AcademicSummaryController;
use App\Http\Controllers\PermintaanSuratController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaKtmController;
use App\Http\Controllers\RiwayatPermintaanSuratController;
use App\Http\Controllers\JadwalImageController;

Route::group(['middleware' => ['auth:mahasiswa']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/courses', [CourseController::class, 'index'])->name('courses');
    Route::get('/grades', [GradeController::class, 'index'])->name('grades');
    Route::get('/academic-summary', [AcademicSummaryController::class, 'index'])->name('academic.summary');
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::get('/news', [NewsController::class, 'index'])->name('news');

    Route::get('/biodata', [MahasiswaController::class, 'index'])->name('biodata');
    Route::get('/ktm', [MahasiswaKtmController::class, 'index'])->name('ktm.index');
    Route::post('/ktm', [MahasiswaKtmController::class, 'store'])->name('ktm.store');
    Route::post('/upload-ktm', [MahasiswaKtmController::class, 'uploadKtm'])->name('mahasiswa.ktm.upload');


    Route::get('/krs', [KrsController::class, 'index'])->name('krs');
    Route::get('/jadwal', [JadwalImageController::class, 'index'])->name('jadwal');
    Route::get('/nilai-mahasiswa', [NilaiMahasiswaController::class, 'index']);
    Route::get('/presensi', [PresensiController::class, 'index']);
    Route::get('/pembayaran-ukt', [PembayaranUktController::class, 'index']);
    Route::get('/cetak-krs', [KrsController::class, 'cetakPdf'])->name('krs.cetak-pdf');

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




