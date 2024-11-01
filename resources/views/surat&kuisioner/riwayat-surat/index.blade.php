@extends('layouts.app')

@section('title', 'Riwayat Permintaan Surat')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <nav class="page-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Surat & Kuisioner</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Riwayat Permintaan Surat</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h3 class="mb-3">Riwayat Permintaan Surat</h3>

                        <div class="table-responsive mt-4">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Tahun Akademik</th>
                                        <th>Jenis Surat</th>
                                        <th>Status</th>
                                        <th>Catatan</th>
                                        <th>Tanggal Permintaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($riwayatSurat as $surat)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $surat->mahasiswa->nim }}</td>
                                            <td>{{ $surat->mahasiswa->nama }}</td>
                                            <td>{{ $surat->semester->nama_semester }}</td>
                                            <td>
                                                @if ($surat->jenis_surat == 1)
                                                    MODELC - Surat Pernyataan Masih Kuliah
                                                @elseif($surat->jenis_surat == 2)
                                                    SKK - Surat Keterangan Kuliah
                                                @elseif($surat->jenis_surat == 3)
                                                    SKLA - Surat Keterangan Lunas Administrasi
                                                @else
                                                    Unknown
                                                @endif
                                            </td>
                                            <td>
                                                @if ($surat->status == 0)
                                                    Ditolak
                                                @elseif ($surat->status == 1)
                                                    Diproses
                                                @elseif ($surat->status == 2)
                                                    Selesai
                                                @else
                                                    Unknown
                                                @endif
                                            </td>
                                            <td>{{ $surat->catatan }}</td>
                                            <td>{{ $surat->created_at->format('d-m-Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
