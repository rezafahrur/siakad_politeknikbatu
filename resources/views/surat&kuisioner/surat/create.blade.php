@extends('layouts.app')

@section('title', 'Create Surat')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <nav class="page-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Surat & Kuisioner</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Permintaan Surat</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h3 class="mb-3">Permintaan Surat</h3>

                        <div class="d-flex justify-content-start mb-3">
                            <div>
                                <a href="surat.html" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                                    <i class="btn-icon-prepend" data-feather="plus-square"></i>
                                    Tambah Data
                                </a>
                            </div>
                        </div>

                        <form action="{{ route('surat.store') }}" method="POST">
                            @csrf
                            <!-- Add your form inputs here -->
                            <div class="form-group">
                                <label for="mahasiswa">Mahasiswa</label>
                                <input type="text" class="form-control" id="mahasiswa" name="mahasiswa" required>
                            </div>
                            <div class="form-group">
                                <label for="tahun_akademik">Tahun Akademik</label>
                                <input type="text" class="form-control" id="tahun_akademik" name="tahun_akademik" required>
                            </div>
                            <div class="form-group">
                                <label for="jenis_surat">Jenis Surat</label>
                                <input type="text" class="form-control" id="jenis_surat" name="jenis_surat" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>

                        <div>
                            <p class="mt-3">
                                <strong>Catatan:</strong>
                                <ul class="mt-2">
                                    <li> Untuk ajuan surat dengan status <b>"Bisa diambil"</b> dapat didownload pada Menu <b>Riwayat Permintaan Surat.</b></li>
                                    <li> Apabila status pengajuan surat <b>PROSES</b> dalam kurun waktu lebih dari 2x24 Jam sejak pengajuan, silakan cek menu <b>Message.</b></li>
                                </ul>
                            </p>
                        </div>

                        <div class="table-responsive mt-4"> 
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Mahasiswa</th>
                                        <th>Tahun Akademik</th>
                                        <th>Jenis Surat</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
