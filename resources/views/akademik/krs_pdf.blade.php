<!DOCTYPE html>
<html>
<head>
    <title>KRS Mahasiswa</title>
    <style>
        body {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>Kartu Rencana Studi (KRS)</h1>
    
    @foreach ($krs as $krsItem)
        @if ($krsItem && $krsItem->paketMatakuliah)
            <h3>Semester {{ $krsItem->paketMatakuliah->semester }}</h3>
            <p><strong>Paket Matakuliah:</strong> {{ $krsItem->paketMatakuliah->nama_paket_matakuliah }}</p>
            <p><strong>Tanggal Transfer:</strong> {{ \Carbon\Carbon::parse($krsItem->tgl_transfer)->format('d-m-Y') }}</p>

            <table>
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
            <br>
        @else
            <p>KRS tidak ditemukan untuk semester ini.</p>
        @endif
    @endforeach
</body>
</html>
