@extends('layouts.app')

@section('title', 'Riwayat Permintaan Surat')

@section('content')
    @php
        function formatTextWithBreaks($text, $wordsPerLine = 5) {
            $words = explode(' ', $text);
            $formattedText = '';

            foreach (array_chunk($words, $wordsPerLine) as $line) {
                $formattedText .= implode(' ', $line) . '<br>';
            }

            return $formattedText;
        }
    @endphp

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
                                        {{-- <th>Tanggal Permintaan</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($riwayatSurat as $surat)
                                        <tr>
                                            <td style="font-size: 12px;">{{ $loop->iteration }}</td>
                                            <td style="font-size: 12px;">{{ $surat->mahasiswa->nim }}</td>
                                            <td style="font-size: 12px;">
                                                @php
                                                    // Get the student's name
                                                    $namaMahasiswa = $surat->mahasiswa->nama;
                                            
                                                    // Split the name into words and add line breaks
                                                    $namaWithLineBreaks = implode('<br>', explode(' ', $namaMahasiswa));
                                                @endphp
                                            
                                                {!! $namaWithLineBreaks !!}
                                            </td>
                                            
                                            <td style="font-size: 12px;">
                                                @php
                                                    // Get the semester name
                                                    $semesterName = $surat->semester->nama_semester;
                                
                                                    // Split the semester name into words and add line breaks
                                                    $semesterNameWithLineBreaks = implode('<br>', explode(' ', $semesterName));
                                                @endphp
                                
                                                {!! $semesterNameWithLineBreaks !!}
                                            </td>
                                            
                                            <td style="font-size: 12px;">
                                                @php
                                                    // Determine the text based on the `jenis_surat` value
                                                    if ($surat->jenis_surat == 1) {
                                                        $text = 'Surat Pernyataan Masih Kuliah';
                                                    } elseif ($surat->jenis_surat == 2) {
                                                        $text = 'Surat Keterangan Kuliah';
                                                    } elseif ($surat->jenis_surat == 3) {
                                                        $text = 'Surat Keterangan Lunas Administrasi';
                                                    } else {
                                                        $text = 'Unknown';
                                                    }
                                
                                                    // Split the text into words and add line breaks
                                                    $textWithLineBreaks = implode('<br>', explode(' ', $text));
                                                @endphp
                                
                                                {!! $textWithLineBreaks !!}
                                            </td>
                                            
                                            <td style="font-size: 12px;">
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
                                            <td style="font-size: 12px;">{!! formatTextWithBreaks($surat->catatan) !!}</td>
                                            {{-- <td>{{ $surat->created_at->format('d-m-Y') }}</td> --}}
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
