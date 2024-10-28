@extends('layouts.app')

@section('title', 'KRS Mahasiswa')

@push('styles')
    <style>
        .student-info {
            margin: 10px 0;
            font-size: 14px;
        }

        .student-info dt {
            float: left;
            clear: left;
            width: 150px;
            position: relative;
        }

        .student-info dt::after {
            content: ":";
            position: absolute;
            right: 10px;
            /* Atur jarak sesuai kebutuhan */
        }

        .student-info dd {
            margin: 0 0 0 5px;
            /* Tambahkan margin sesuai lebar dt */
        }
    </style>
@endpush

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <nav class="page-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Akademik</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Krs</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-content">
            <div class="card-body">
                {{-- title --}}
                <h4 class="mb-3">Kartu Rencana Studi (KRS)</h4>
                @if (!$krs)
                    <!-- Pesan jika tidak ada data KRS -->
                    <p>KRS tidak ditemukan untuk mahasiswa ini.</p>
                @else
                    <!-- Kolom KRS -->
                    <div class="row">
                        <div class="student-info">
                            <dl>
                                <dt>Tahun Akademik</dt>
                                <dd>{{ $krs->kurikulum->semesters->nama_semester }}</dd>

                                <dt>Program Studi</dt>
                                <dd>
                                    {{ $krs->kurikulum->programStudi->nama_program_studi }}
                                </dd>

                                <dt>Kelas</dt>
                                <dd>
                                    {{ $krs->kelas->nama_kelas }}
                                </dd>

                                {{-- ip semester lalu --}}
                                <dt>IP Semester Lalu</dt>
                                <dd>0.00</dd>

                                {{-- ip komulatif --}}
                                <dt>IP Komulatif</dt>
                                <dd>0.00</dd>
                            </dl>
                        </div>
                    </div>

                    <!-- Table for Matakuliah Details -->
                    <div class="table-responsive mb-3">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    {{-- no --}}
                                    <th scope="col">No</th>
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
                                        <td>{{ $loop->iteration }}</td>
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
