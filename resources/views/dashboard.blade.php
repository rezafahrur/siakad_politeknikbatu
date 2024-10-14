@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h4 style="opacity: 50%">{{ $mahasiswa->nim }} / {{ $mahasiswa->nama }}</h3>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">Siakad</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Dashboard
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Data Mahasiswa</h6>
                    <li style="display: flex;">
                        <span style="flex: 0 0 150px;"><i class="bi bi-person-circle"></i> NIM</span>:&nbsp;
                        <strong style="color:blue">{{ $mahasiswa->nim }}</strong>
                    </li>
                    <li style="display: flex;">
                        <span style="flex: 0 0 150px;"><i class="bi bi-person"></i> Nama</span>:&nbsp;
                        <strong>{{ $mahasiswa->nama }}</strong>
                    </li>
                    <li style="display: flex;">
                        <span style="flex: 0 0 150px;"><i class="bi bi-journal"></i> Jurusan</span>:&nbsp;
                        <strong>{{ $mahasiswa->jurusan->nama_jurusan }}</strong>
                    </li>
                    <li style="display: flex;">
                        <span style="flex: 0 0 150px;"><i class="bi bi-journal-text"></i> Program Studi</span>:&nbsp;
                        <strong>{{ $mahasiswa->programStudi->nama_program_studi }}</strong>
                    </li>
                    <li style="display: flex;">
                        <span style="flex: 0 0 150px;"><i class="bi bi-calendar"></i> Semester</span>:&nbsp;
                        <strong>{{ $mahasiswa->semester_berjalan }}</strong>
                    </li>
                    <li style="display: flex;">
                        <span style="flex: 0 0 150px;">
                            <i class="bi bi-calendar2-check"></i> Registration Date
                        </span>:&nbsp;
                        <strong>{{ \Carbon\Carbon::parse($mahasiswa->registrasi_tanggal)->translatedFormat('d F Y') }}</strong>
                    </li>
                    <li style="display: flex;">
                        <span style="flex: 0 0 150px;"><i class="bi bi-info-circle"></i> Status</span>:&nbsp;
                        <strong style="color: {{ $mahasiswa->status ? 'green' : 'red' }}">
                            {{ $mahasiswa->status ? 'Aktif' : 'Nonaktif' }}
                        </strong>
                    </li>
                    <li style="display: flex;">
                        <span>
                            <i class="bi bi-link"></i>
                            <a target="_blank">
                                PDDIKTI KEMENDIKBUD
                            </a> &gt;
                        </span>&nbsp;
                        <a href="https://pddikti.kemdikbud.go.id/search/{{ $mahasiswa->nim }}" target="_blank"
                            style="color:blue;">
                            <strong>Detail</strong>
                        </a>
                    </li>
                </div>
            </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Jadwal Kuliah Hari {{ $hari }} </h6>
                    <ul class="list-group mb-2">
                        <li class="list-group-item">08:00 - 10:00: -</li>
                        <li class="list-group-item">10:15 - 12:15: -</li>
                        <li class="list-group-item">13:00 - 15:00: -</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">Lihat Jadwal</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Status Pembayaran UKT -->
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Riwayat Pembayaran UKT</h6>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Akademik</th>
                                    <th>Keterangan</th>
                                    <th>Tagihan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td>1</td>
                                <td>2024/2025 Ganjil</td>
                                <td>UKT-1</td>
                                <td>-</td>
                                <td class="text-success">-</td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" style="background-color: #000865;"> <!-- Biru Muda -->
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Survey Desain KTM
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the first item's accordion body.</strong> It is shown by default, until
                                    the collapse.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Email Mahasiswa
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Email mahasiswa Anda adalah <strong>{{ $mahasiswa->email }}</strong>.<br>
                                    Untuk masuk ke email mahasiswa, silahkan buka https://gapura.batu.ac.id kemudian klik
                                    Login.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Bantuan Keuangan
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Pengumuman SIBAKU dapat dilihat dengan klik disini.
                                </div>
                            </div>
                        </div>
                        {{-- colapseFour --}}
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Cuti dan Pengunduran Diri Mahasiswa
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Pengajuan cuti dan pengunduran diri mahasiswa dapat dilakukan dengan mengisi formulir
                                    yang tersedia di bagian akademik.
                                </div>
                            </div>
                        </div>
                        {{-- pddikti --}}
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    PDDIKTI KEMENDIKBUD
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Klik di sini untuk update data kebutuhan PDDIKTI (Kemendikbud).
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Berita -->
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Pengumuman</h6>
                    <ul>
                        {{-- foreach berita tampilkan judulnya aja --}}
                        @foreach ($berita as $item)
                            <li>{{ $item->judul_berita }}</li>
                        @endforeach
                    </ul>
                    <a href="" class="btn btn-primary mt-2">Lihat Semua</a>
                </div>
            </div>
        </div>
    </div>
@endsection
