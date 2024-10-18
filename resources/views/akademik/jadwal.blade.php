@extends('layouts.app')

@section('title', 'Jadwal Mahasiswa')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <nav class="page-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Akademik</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Jadwal</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Jadwal Kelas</h5>

                @if ($jadwalImage)
                    {{-- Display image if it's an image file --}}
                    <div class="mb-3">
                        <h6>Preview Jadwal:</h6>
                        @if (in_array(pathinfo($jadwalImage->file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ $path_file_jadwal . '/upload/jadwal-images/' . $jadwalImage->file }}"
                                alt="Jadwal Image" class="img-fluid" style="max-width: 100%; height: auto;">
                        @else
                            <p>File jadwal tidak berupa gambar.</p>
                        @endif
                    </div>

                    {{-- Provide download link --}}
                    <div class="mb-3">
                        <a href="{{ $path_file_jadwal . '/upload/jadwal-images/' . $jadwalImage->file }}" download
                            class="btn btn-primary">
                            Download
                        </a>
                    </div>
                @else
                    <p>Tidak ada jadwal tersedia untuk kelas Anda.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
