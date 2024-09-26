@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Selamat Datang, RIZALDY</h4>
        <p class="mb-1">NIM: 2141720115</p>
        <p class="mb-1">Program Studi: D4 - Teknik Informatika</p>
    </div>
    
</div>

<div class="row">
    <!-- Ringkasan Akademik -->
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Ringkasan Akademik</h6>
                <p class="mb-2">Semester Aktif: Ganjil 2024/2025</p>
                <p class="mb-2">Jumlah SKS: 22 SKS</p>
                <p class="mb-2">IPK: 3.75</p>
                <a href="krs.html" class="btn btn-primary mt-2">Lihat KRS</a>
            </div>
        </div>
    </div>

    <!-- Status Pembayaran UKT -->
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Status Pembayaran UKT</h6>
                <p class="text-success mb-2">UKT telah dibayar.</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Jadwal Kuliah Hari Ini -->
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Jadwal Kuliah Hari Ini</h6>
                <ul class="mb-2">
                    <li>08:00 - 10:00: Algoritma dan Pemrograman</li>
                    <li>10:15 - 12:15: Matematika Diskrit</li>
                    <li>13:00 - 15:00: Basis Data</li>
                    <li>15:15 - 17:15: Struktur Data</li>
                </ul>
                <a href="jadwal.html" class="btn btn-secondary mt-2">Lihat Jadwal Lengkap</a>
            </div>
        </div>
    </div>

    <!-- Progress Tugas -->
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Progress Tugas</h6>
                <div class="progress mb-2">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">Pemrograman Web - 80%</div>
                </div>
                <div class="progress mb-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">Sistem Operasi - 60%</div>
                </div>
                <div class="progress mb-2">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">Analisis Algoritma - 40%</div>
                </div>
                <div class="progress mb-2">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Jaringan Komputer - 20%</div>
                </div>
                <a href="tugas.html" class="btn btn-secondary mt-2">Lihat Semua Tugas</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Berita -->
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Berita</h6>
                <ul>
                    <li>Workshop Pengembangan Karir - 25 September 2024</li>
                    <li>Pengumuman Wisuda - 30 September 2024</li>
                    <li>Pelatihan Soft Skills - 1 Oktober 2024</li>
                </ul>
                <a href="pengumuman.html" class="btn btn-info mt-2">Lihat Semua Berita</a>
            </div>
        </div>
    </div>

    <!-- Statistik Akademik -->
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Statistik Akademik</h6>
                <ul class="mb-2">
                    <li>Jumlah Mata Kuliah Lulus: 15</li>
                    <li>Jumlah Mata Kuliah Tidak Lulus: 1</li>
                    <li>Rata-rata Nilai: 3.6</li>
                    <li>Jumlah SKS Diambil: 144 SKS</li>
                    <li>Jumlah SKS Lulus: 138 SKS</li>
                </ul>
                <a href="statistik.html" class="btn btn-secondary mt-2">Lihat Statistik Lengkap</a>
            </div>
        </div>
    </div>
</div>
@endsection
