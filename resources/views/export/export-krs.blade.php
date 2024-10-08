<!DOCTYPE html>
<html>

<head>
    <title>KRS Mahasiswa</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .page-heading h3 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>

<body>
    <div class="page-heading">
        <h3>Kartu Rencana Studi (KRS)</h3>
    </div>

    <div>
        <dl>
            <dt>Tahun Akademik:</dt>
            <dd>{{ $krs->kurikulum->semesters->nama_semester }}</dd>

            <dt>Program Studi:</dt>
            <dd>{{ $krs->kurikulum->programStudi->kode_program_studi }} -
                {{ $krs->kurikulum->programStudi->nama_program_studi }}</dd>

            <dt>Kelas:</dt>
            <dd>{{ $krs->kelas->nama_kelas }}</dd>

            <dt>IP Semester Lalu:</dt>
            <dd>0</dd>

            <dt>IP Komulatif:</dt>
            <dd>0</dd>
        </dl>
    </div>

    <table>
        <thead>
            <tr>
                <th>Kode Mata Kuliah</th>
                <th>Nama Mata Kuliah</th>
                <th>Semester</th>
                <th>Sks</th>
                <th>Jam</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($krs->kelas->details as $detail)
                <tr>
                    <td>{{ $detail->kurikulumDetail->matakuliah->kode_matakuliah ?? 'N/A' }}</td>
                    <td>{{ $detail->kurikulumDetail->matakuliah->nama_matakuliah ?? 'N/A' }}</td>
                    <td>{{ $krs->kurikulum->semester_angka }}</td>
                    <td>{{ $detail->kurikulumDetail->matakuliah->total_sks ?? 'N/A' }}</td>
                    <td>{{ $detail->kurikulumDetail->matakuliah->jam ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
