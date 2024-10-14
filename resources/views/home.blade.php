@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Student Dashboard</h3>
                    <p class="text-subtitle text-muted">
                        Welcome to your academic dashboard.
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Home
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <!-- Academic Summary Widget -->
                <div class="col-lg-8 col-md-6 col-sm-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title"><i class="bi bi-bookmark-star"></i> Academic Summary</h4>
                        </div>
                        <div class="card-body mt-3">
                            <ul class="list-unstyled">
                                <li style="display: flex;">
                                    <span style="flex: 0 0 150px;"><i class="bi bi-person-circle"></i> NIM</span>:&nbsp;
                                    <strong style="color:blue">{{ $mahasiswa->nim }}</strong>
                                </li>
                                <li style="display: flex;">
                                    <span style="flex: 0 0 150px;"><i class="bi bi-person"></i> Name</span>:&nbsp;
                                    <strong>{{ $mahasiswa->nama }}</strong>
                                </li>
                                <li style="display: flex;">
                                    <span style="flex: 0 0 150px;"><i class="bi bi-journal"></i> Jurusan</span>:&nbsp;
                                    <strong>{{ $mahasiswa->jurusan->nama_jurusan }}</strong>
                                </li>
                                <li style="display: flex;">
                                    <span style="flex: 0 0 150px;"><i class="bi bi-journal-text"></i> Program
                                        Studi</span>:&nbsp;
                                    <strong>{{ $mahasiswa->programStudi->nama_program_studi }}</strong>
                                </li>
                                <li style="display: flex;">
                                    <span style="flex: 0 0 150px;"><i class="bi bi-calendar"></i> Semester</span>:&nbsp;
                                    <strong>{{ $mahasiswa->semester_berjalan }}</strong>
                                </li>
                                <li style="display: flex;">
                                    <span style="flex: 0 0 150px;"><i class="bi bi-calendar2-check"></i> Registration
                                        Date</span>:&nbsp;
                                    <strong>{{ \Carbon\Carbon::parse($mahasiswa->registrasi_tanggal)->format('d-m-Y') }}</strong>
                                </li>
                                <li style="display: flex;">
                                    <span style="flex: 0 0 150px;"><i class="bi bi-info-circle"></i> Status</span>:&nbsp;
                                    <strong style="color: blue">{{ $mahasiswa->status ? 'Active' : 'Inactive' }}</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Upcoming Classes Widget -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title"><i class="bi bi-calendar-event"></i> Upcoming Classes</h4>
                        </div>
                        <div class="card-body mt-3">
                            <ul class="list-unstyled">
                                <li><i class="bi bi-clock"></i> Mon, 9:00 AM - Database Systems</li>
                                <li><i class="bi bi-clock"></i> Tue, 11:00 AM - Software Engineering</li>
                                <li><i class="bi bi-clock"></i> Wed, 1:00 PM - Web Development</li>
                                <li><i class="bi bi-clock"></i> Wed, 1:00 PM - Mobile Development</li>
                            </ul>
                            <a href="{{ route('schedule') }}" class="btn btn-primary mt-2">View Full Schedule</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="row mt-4">
                <!-- Latest News Widget -->
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title"><i class="bi bi-newspaper"></i> Latest News</h4>
                        </div>
                        <div class="card-body mt-3">
                            <p>Stay updated with the latest news and announcements from the campus.</p>
                            <a href="{{ route('news') }}" class="btn btn-primary mt-2">Read More</a>
                        </div>
                    </div>
                </div>

                <!-- Quick Links Widget -->
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title"><i class="bi bi-link-45deg"></i> Quick Links</h4>
                        </div>
                        <div class="card-body mt-3">
                            <ul class="list-unstyled">
                                <li><a href="{{ route('profile') }}" class="text-decoration-none text-dark"><i
                                            class="bi bi-person-circle"></i> My Profile</a></li>
                                <li><a href="{{ route('courses') }}" class="text-decoration-none text-dark"><i
                                            class="bi bi-journal"></i> My Courses</a></li>
                                <li><a href="{{ route('grades') }}" class="text-decoration-none text-dark"><i
                                            class="bi bi-file-earmark-bar-graph"></i> My Grades</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="row mt-2">
                {{-- Judul Berita Terbaru --}}
                <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                    <h4>Berita Terbaru</h4>
                </div>
                <!-- Latest News -->
                @foreach ($berita as $item)
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-content">
                                @php
                                    $imagePath =
                                        $item->path_photo && file_exists(public_path($item->path_photo))
                                            ? asset($item->path_photo)
                                            : asset('assets/compiled/jpg/building.jpg');
                                @endphp
                                <img class="card-img-bottom img-fluid" src="{{ $imagePath }}"
                                    alt="{{ $item->judul_berita }}" style="height: 20rem; object-fit: cover" />
                                <div class="card-body">
                                    <h4 class="card-title">{{ $item->judul_berita }}</h4>
                                    <p class="card-text">
                                        {{ Str::limit(strip_tags($item->isi_berita), 150) }}
                                    </p>
                                    <a href="#" class="card-link">
                                        <small>{{ $item->views }} Views</small>
                                    </a>
                                </div>
                                <div class="btn-group align-items-center mx-2 px-1">
                                    <button type="button" class="btn btn-link p-2 m-1 text-decoration-none">
                                        <i
                                            class="bi bi-heart d-flex align-items-center justify-content-center text-secondary"></i>
                                    </button>
                                    <button type="button" class="btn btn-link p-2 m-1 text-decoration-none">
                                        <i
                                            class="bi bi-chat d-flex align-items-center justify-content-center text-secondary"></i>
                                    </button>
                                    <button type="button" class="btn btn-link p-2 m-1 text-decoration-none">
                                        <i
                                            class="bi bi-bookmark d-flex align-items-center justify-content-center text-secondary"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

@endsection
