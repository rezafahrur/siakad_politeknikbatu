@extends('layouts.app')

@section('title', 'Permintaan Surat')

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
                                <a href="#" class="btn btn-primary btn-icon-text mb-2 mb-md-0" data-bs-toggle="modal"
                                    data-bs-target="#tambahDataModal">
                                    <i class="btn-icon-prepend" data-feather="plus-square"></i>
                                    Tambah Data
                                </a>
                            </div>
                        </div>

                        <div>
                            <p class="mt-3">
                                <strong>Catatan:</strong>
                            <ul class="mt-2">
                                <li> Untuk ajuan surat dengan status <b>"Bisa diambil"</b> dapat didownload pada Menu
                                    <b>Riwayat Permintaan Surat.</b>
                                </li>
                                <li> Apabila status pengajuan surat <b>PROSES</b> dalam kurun waktu lebih dari 2x24 Jam
                                    sejak pengajuan, silakan cek menu <b>Message.</b></li>
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

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataModalLabel">Tambah Permintaan Surat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('surat.store') }}" method="POST">
                        @csrf
                        <!-- Hidden inputs for mahasiswa_id and semester_id -->
                        <input type="hidden" name="mahasiswa_id" value="{{ $mahasiswa->id }}">
                        <input type="hidden" name="semester_id" value="{{ $semester ? $semester->id : '' }}">
                    
                        <div class="mb-3">
                            <input type="text" class="form-control" id="mahasiswa" name="mahasiswa"
                                   value="NIM : {{ $mahasiswa->nim }}" readonly>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="semester" name="semester"
                                   value="Semester : {{ $semester ? $semester->nama_semester : 'Tidak ada data' }}" readonly>
                        </div>
                    
                        <!-- Select for jenis_surat and additional fields -->
<!-- Select for jenis_surat and additional fields -->
                        <div class="mb-3">
                            <label for="jenis_surat" class="form-label">Jenis Surat</label>
                            <select class="form-select" id="jenis_surat" name="jenis_surat" required>
                                <option selected disabled value="">Pilih Jenis Surat</option>
                                <option value="1">MODELC - Surat Pernyataan Masih Kuliah</option>
                                <option value="2">SKK - Surat Keterangan Kuliah</option>
                                <option value="3">SKLA - Surat Keterangan Lunas Administrasi</option>
                            </select>
                        </div>

                        <div id="modelCInputs" style="display: none;">
                            <!-- Dropdown for Nama -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <select class="form-select" id="nama" name="nama" required>
                                    <option selected disabled value="">Pilih Nama</option>
                                    @foreach ($mahasiswaWali as $wali)
                                        <option value="{{ $wali->nama }}">{{ $wali->nama }}</option>
                                    @endforeach
                                    @if ($mahasiswaWali->isEmpty())
                                        <option disabled>Tidak ada data wali mahasiswa</option>
                                    @endif
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP/NRP/NPP</label>
                                <input type="text" class="form-control" id="nip" name="nip">
                            </div>
                            <div class="mb-3">
                                <label for="pangkat" class="form-label">Pangkat / Golongan</label>
                                <input type="text" class="form-control" id="pangkat" name="pangkat">
                            </div>
                            <div class="mb-3">
                                <label for="instansi" class="form-label">Instansi</label>
                                <input type="text" class="form-control" id="instansi" name="instansi">
                            </div>
                        </div>

                    
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('jenis_surat').addEventListener('change', function() {
            const selectedValue = this.value;
            const modelCInputs = document.getElementById('modelCInputs');
            if (selectedValue === "1") { // MODELC
                modelCInputs.style.display = 'block';
            } else {
                modelCInputs.style.display = 'none';
            }
        });
    </script>
    

@endsection
