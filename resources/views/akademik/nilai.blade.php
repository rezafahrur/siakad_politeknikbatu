@extends('layouts.app')

@section('title', 'Nilai Mahasiswa')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <nav class="page-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Akademik</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nilai</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <h4 class="mb-3">Nilai Mahasiswa</h4>
                <form method="GET" action="{{ route('nilai') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <select name="semester" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Semester</option>
                                @foreach ($semesters as $smt)
                                    <option value="{{ $smt }}" {{ $smt == $semester ? 'selected' : '' }}>
                                        Semester {{ $smt }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>

                @if ($nilaiDetails->isEmpty())
                    <p class="text-muted">Tidak ada data nilai.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode MK</th>
                                <th>Nama Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Jam</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nilaiDetails as $index => $nilai)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $nilai->nilai->matakuliah->kode_matakuliah }}</td>
                                    <td>{{ $nilai->nilai->matakuliah->nama_matakuliah }}</td>
                                    <td>{{ $nilai->nilai->matakuliah->total_sks }}</td>
                                    <td>{{ $nilai->nilai->matakuliah->jam }}</td>
                                    <td>{{ $nilai->nilai_huruf }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
