@extends('layouts.app')

@section('title', 'Kuisioner Akademik')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <nav class="page-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Kuisioner Akademik</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar Kuisioner</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h3 class="mb-3">Daftar Kuisioner Akademik</h3>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="table-responsive mt-4">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pertanyaan</th>
                                        <th>Pilihan Jawaban</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="{{ route('kuisioner.submit') }}" method="POST">
                                        @csrf
                                        @foreach ($kuisioner as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->pertanyaan_kuisioner }}</td>
                                                <td>
                                                    @if (isset($jawaban[$item->id]))
                                                        <input type="text" class="form-control"
                                                            value="{{ $jawaban[$item->id]->jawaban }}" readonly>
                                                    @else
                                                        <select name="jawaban[{{ $item->id }}]" class="form-control"
                                                            required>
                                                            <option value="">Pilih Jawaban</option>
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <option value="{{ $i }}">{{ $i }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </form>
                                </tbody>
                            </table>
                            @if (!$jawaban->isNotEmpty())
                                <div class="d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </div>
                            @endif
                        </div>

                        @if ($jawaban->isNotEmpty())
                            <div class="mt-4">
                                <h5>Jawaban Anda:</h5>
                                <ul class="list-group">
                                    @foreach ($jawaban as $item)
                                        <li class="list-group-item">
                                            Pertanyaan {{ $item->kuisioner_id }}: Jawaban {{ $item->jawaban }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
