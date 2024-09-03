@extends('layouts.app')

@section('title', 'Jadwal Mahasiswa')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Jadwal Mahasiswa</h3>
                    <p class="text-subtitle text-muted">
                        Welcome to your student schedule page
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Jadwal
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card shadow-sm mb-4">
                <div class="card-header mb-2">
                    <h4>Paket : {{ $jadwal->paketMataKuliah->nama_paket_matakuliah ?? 'N/A' }}</h4>
                </div>
                <div class="card-body">
                    <h6 class="mb-3">Detail Jadwal:</h6>
                    @if ($jadwal->details->isEmpty())
                        <p>Tidak ada detail tersedia.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Mata Kuliah</th>
                                        <th scope="col">Ruang Kelas</th>
                                        <th scope="col">Hari</th>
                                        <th scope="col">Waktu</th>
                                        <th scope="col">Dosen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwal->details as $detail)
                                        <tr>
                                            <td>{{ $detail->paketMataKuliahDetail->matakuliah->nama_matakuliah ?? 'N/A' }}
                                            </td>
                                            <td>{{ $detail->ruangKelas->nama_ruang_kelas ?? 'N/A' }}</td>
                                            <td>
                                                @php
                                                    $days = [
                                                        1 => 'Senin',
                                                        2 => 'Selasa',
                                                        3 => 'Rabu',
                                                        4 => 'Kamis',
                                                        5 => 'Jumat',
                                                        6 => 'Sabtu',
                                                        7 => 'Minggu',
                                                    ];
                                                    echo $days[$detail->jadwal_hari] ?? 'N/A';
                                                @endphp
                                            </td>
                                            <td>
                                                {{ substr($detail->jadwal_jam_mulai, 0, 5) ?? 'N/A' }} -
                                                {{ substr($detail->jadwal_jam_akhir, 0, 5) ?? 'N/A' }}
                                            </td>
                                            <td>{{ $detail->hr->nama ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection
