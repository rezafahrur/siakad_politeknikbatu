@extends('layouts.app')

@section('title', 'KRS Mahasiswa')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Kartu Rencana Studi (KRS)</h3>
                    {{-- <p class="text-subtitle text-muted">
                        Who does not love tables?
                    </p> --}}
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

                @if ($krs->isEmpty())
                    <p>Tidak ada KRS yang tersedia.</p>
                @else
                    @foreach ($krs as $krsItem)
                        @if ($krsItem && $krsItem->paketMatakuliah)
                            <!-- Semester Header -->
                            <h4 class="mb-2">Semester {{ $krsItem->paketMatakuliah->semester }}</h4>

                            <!-- Kolom KRS -->
                            <div class="row">
                                <div class="col-md-12">
                                    <dl class="row">
                                        <dt class="col-sm-2">Tanggal Transfer</dt>
                                        <dd class="col-sm-10">
                                            {{ \Carbon\Carbon::parse($krsItem->tgl_transfer)->format('d-m-Y') }}
                                        </dd>

                                        <dt class="col-sm-2">Paket Matakuliah</dt>
                                        <dd class="col-sm-10">
                                            {{ $krsItem->paketMatakuliah->nama_paket_matakuliah }}
                                        </dd>

                                        <dt class="col-sm-2">Total SKS</dt>
                                        <dd class="col-sm-10">
                                            @php
                                                $totalSks = 0;
                                                foreach ($krsItem->paketMatakuliah->paketMatakuliahDetail as $matkul) {
                                                    $totalSks += $matkul->matakuliah->sks;
                                                }
                                                echo $totalSks;
                                            @endphp
                                        </dd>
                                    </dl>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Mata Kuliah</th>
                                            <th>Nama Mata Kuliah</th>
                                            <th>SKS</th>
                                            <th>Jam</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($krsItem->paketMatakuliah->paketMatakuliahDetail as $index => $matkul)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $matkul->matakuliah->kode_matakuliah }}</td>
                                                <td>{{ $matkul->matakuliah->nama_matakuliah }}</td>
                                                <td>{{ $matkul->matakuliah->sks }}</td>
                                                <td>{{ $matkul->matakuliah->sks * 2 }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>KRS tidak ditemukan untuk semester ini.</p>
                        @endif
                    @endforeach
                @endif
                <div class="mb-3">
                    <a href="{{ route('krs.cetak-pdf') }}" class="btn btn-success" target="_blank">
                        <i class="fas fa-file-pdf"></i> Cetak PDF
                    </a>
                </div>
            </div>

        </div>
    </div>



@endsection
