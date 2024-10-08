<!DOCTYPE html>
<html>

<head>
    <title>KRS Mahasiswa</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .header {
            display: flex;
            justify-content: center; 
            align-items: center;
            font-size: 12px;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
            position: relative; 
        }

        .header img {
            width: 100px;
            position: absolute; 
            left: 0; 
        }

        .header .center-text {
            text-align: center;
        }

        .header p {
            margin: 0;
        }

        .page-heading h3 {
            text-align: center;
            margin: 20px 0;
            text-transform: uppercase;
            font-size: 16px;
        }

        .student-info {
            margin: 20px 0;
            font-size: 12px;
        }

        .student-info dt {
            float: left;
            clear: left;
            width: 150px;
        }

        .student-info dd {
            margin: 0 0 5px 160px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 6px;
            text-align: center;
        }

        .total-row {
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
        }

        .footer-left {
            float: left;
            width: 50%;
            text-align: center;
        }

        .footer-right {
            float: right;
            width: 50%;
            text-align: center;
        }

        .clearfix {
            clear: both;
        }

        .underline {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="assets\images\logo\logo.png" alt="Logo Poltek Batu">
        <div class="center-text">
            <p>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</p>
            <p><strong>POLITEKNIK BATU</strong></p>
            <p>Jl Sawahan Bawah No.20 Kota Batu Jawa Timur 65326</p>
            <p>Telp. 088990020000</p>
            <p>Website: https://poltekbatu.ac.id/</p>
            <p>E-mail: politeknikbatu@gmail.com</p>
        </div>
    </div>

    <div class="page-heading">
        <h3>Kartu Rencana Studi (KRS)</h3>
    </div>

    <div class="student-info">
        <dl>
            <dt>Nama Mahasiswa</dt>
            <dd>{{ $krs->mahasiswa->nama }}</dd>

            <dt>NIM</dt>
            <dd>{{ $krs->mahasiswa->nim }}</dd>

            <dt>Tingkat / Kelas</dt>
            <dd>{{ $krs->mahasiswa->semester_berjalan ?? 'N/A' }} / {{ $krs->kelas->nama_kelas }}</dd>

            <dt>Program Studi</dt>
            <dd>{{ $krs->kurikulum->programStudi->nama_program_studi }}</dd>

            <dt>Semester</dt>
            <dd>{{ $krs->kelas->semester->semester ?? 'N/A' }}</dd>

            <dt>Tahun Akademik</dt>
            <dd>{{ $krs->kelas->semester->nama_semester ?? 'N/A' }}</dd>
        </dl>
    </div>

    <table>
        <thead>
            <tr>
                <th>KODE MK</th>
                <th>MATA KULIAH</th>
                <th>SKS</th>
                <th>JAM</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($krs->kelas->details as $detail)
                <tr>
                    <td>{{ $detail->kurikulumDetail->matakuliah->kode_matakuliah ?? 'N/A' }}</td>
                    <td>{{ $detail->kurikulumDetail->matakuliah->nama_matakuliah ?? 'N/A' }}</td>
                    <td>{{ $detail->kurikulumDetail->matakuliah->total_sks ?? 'N/A' }}</td>
                    <td>{{ $detail->kurikulumDetail->matakuliah->jam ?? 'N/A' }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="2">JUMLAH</td>
                <td>{{ $krs->total_sks }}</td>
                <td>{{ $krs->total_jam }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <div class="footer-left">
            <br><br>
            <p>Mahasiswa</p>
            <br><br><br>
            <p>(..............................................)</p>
        </div>
        <div class="footer-right">
            <p>Batu, {{ date('d F Y') }}</p>
            <p>Dosen Pembina Akademik,</p>
            <br><br><br>
            <p>(..............................................)</p>
        </div>
        <div class="clearfix"></div>
    </div>
</body>

</html>
