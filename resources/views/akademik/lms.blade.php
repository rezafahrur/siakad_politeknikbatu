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

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Learning Management System(LMS) - POLTEKBATU</h5>

            {{-- button connect to lms poltekbatu --}}
            <div class="mb-3">
                <a href="https://lms.poltekbatu.ac.id/" class="btn btn-primary">
                    Connect to LMS
                </a>
            </div>

        </div>
    </div>
@endsection
