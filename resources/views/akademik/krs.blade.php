@extends('layouts.app')

@section('title', 'KRS Mahasiswa')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Kartu Rencana Studi (KRS)</h3>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                KRS
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <!-- Tambahkan Button Cetak PDF di Sini -->

                @if (!$krs)
                    <!-- Pesan jika tidak ada data KRS -->
                    <p>KRS tidak ditemukan untuk mahasiswa ini.</p>
                @else
                    <!-- Kolom KRS -->
                    <div class="row">
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">Tahun Akademik</dt>
                                <dd class="col-sm-8">{{ $krs->kurikulum->semesters->nama_semester }}</dd>

                                <dt class="col-sm-4">Program Studi</dt>
                                <dd class="col-sm-8">
                                    {{ $krs->kurikulum->programStudi->kode_program_studi }} -
                                    {{ $krs->kurikulum->programStudi->nama_program_studi }}
                                </dd>

                                <dt class="col-sm-4">Kelas</dt>
                                <dd class="col-sm-8">{{ $krs->kelas->nama_kelas }}</dd>

                                {{-- ip semester lalu --}}
                                <dt class="col-sm-4">IP Semester Lalu</dt>
                                <dd class="col-sm-8">0.00</dd>

                                {{-- ip komulatif --}}
                                <dt class="col-sm-4">IP Komulatif</dt>
                                <dd class="col-sm-8">0.00</dd>
                            </dl>
                        </div>
                    </div>

                    <!-- Table for Matakuliah Details -->
                    <div class="table-responsive mb-3">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Kode Mata Kuliah</th>
                                    <th scope="col">Nama Mata Kuliah</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Sks</th>
                                    <th scope="col">Jam</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($krs->kelas->details as $detail)
                                    <tr>
                                        <td>{{ $detail->kurikulumDetail->matakuliah->kode_matakuliah ?? 'N/A' }}</td>
                                        <td>{{ $detail->kurikulumDetail->matakuliah->nama_matakuliah ?? 'N/A' }}</td>
                                        <td>{{ $krs->kurikulum->semester_angka }}</td>
                                        <td>{{ $detail->kurikulumDetail->matakuliah->total_sks ?? 'N/A' }}</td>
                                        <td>{{ $detail->kurikulumDetail->matakuliah->jam ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Button Cetak PDF -->
                    <div class="mb-3">
                        <a href="{{ route('krs.cetak-pdf') }}" class="btn btn-success" target="_blank">
                            <i class="fas fa-file-pdf"></i> Cetak PDF
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
