<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\AcademicSummaryController;
use App\Http\Controllers\JadwalPerkuliahanController;
use App\Http\Controllers\KeringananUktController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\KuisionerController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NilaiMahasiswaController;
use App\Http\Controllers\PembayaranUktController;
use App\Http\Controllers\PermintaanSuratController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\RiwayatPermintaanSuratController;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/courses', [CourseController::class, 'index'])->name('courses');
Route::get('/grades', [GradeController::class, 'index'])->name('grades');
Route::get('/academic-summary', [AcademicSummaryController::class, 'index'])->name('academic.summary');
Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
Route::get('/news', [NewsController::class, 'index'])->name('news');

Route::get('/krs', [KrsController::class, 'index']);
Route::get('/jadwal-perkuliahan', [JadwalPerkuliahanController::class, 'index']);
Route::get('/nilai-mahasiswa', [NilaiMahasiswaController::class, 'index']);
Route::get('/presensi', [PresensiController::class, 'index']);
Route::get('/pembayaran-ukt', [PembayaranUktController::class, 'index']);


