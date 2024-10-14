<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;

class KrsController extends Controller
{
    public function index()
    {
        // Mendapatkan KRS terbaru sesuai mahasiswa_id
        $krs = Krs::where('mahasiswa_id', Session::get('mahasiswa_id'))
            ->orderByDesc('created_at') // Order by the latest created KRS
            ->first(); // Get only the latest one

        if (!$krs) {
            return view('akademik.krs', ['krs' => []]);
        }

        return view('akademik.krs', compact('krs'));
    }


    // public function cetakPDF()
    // {
    //     $krs = Krs::where('mahasiswa_id', Session::get('mahasiswa_id'))
    //         ->orderByDesc('created_at') // Order by the latest created KRS
    //         ->first(); // Get only the latest one

    //     if (!$krs) {
    //         return redirect()->back()->with('error', 'KRS tidak ditemukan.');
    //     }

    //     // total sks dari penjumlahan ini krs->kelas->detail->kurikulumDetail->matakuliah->total_sks
    //     $krs->total_sks = $krs->kelas->details->sum(function ($detail) {
    //         return $detail->kurikulumDetail->matakuliah->total_sks;
    //     });

    //     // total jam berdasarkan jenis matakuliah
    //     $krs->total_jam = $krs->kelas->details->sum(function ($detail) {
    //         $matakuliah = $detail->kurikulumDetail->matakuliah;
    //         if ($matakuliah->jenis_matakuliah == 'A') {
    //             return $matakuliah->total_sks * 2;
    //         } elseif ($matakuliah->jenis_matakuliah == 'W') {
    //             return $matakuliah->total_sks * 1;
    //         } else {
    //             return $matakuliah->total_sks * 2; // Default case if needed
    //         }
    //     });
    //     // Buat view PDF
    //     $pdf = Pdf::loadView('export.export-krs', compact('krs'));

    //     $namaFile = 'KRS_' . Session::get('nama') . '.pdf';

    //     // Tambahkan opsi untuk mengizinkan remote URL dan HTML5 parsing
    //     $pdf->set_option('isRemoteEnabled', true);
    //     $pdf->set_option('isHtml5ParserEnabled', true);

    //     // Unduh PDF dengan nama file KRS_NAMA_MAHASISWA.pdf
    //     return $pdf->download($namaFile);
    // }

    public function cetakPDF()
    {
        $krs = Krs::where('mahasiswa_id', Session::get('mahasiswa_id'))
            ->orderByDesc('created_at')
            ->first();

        if (!$krs) {
            return redirect()->back()->with('error', 'KRS tidak ditemukan.');
        }

        // Total SKS dan jam
        $krs->total_sks = $krs->kelas->details->sum(function ($detail) {
            return $detail->kurikulumDetail->matakuliah->total_sks;
        });

        $krs->total_jam = $krs->kelas->details->sum(function ($detail) {
            $matakuliah = $detail->kurikulumDetail->matakuliah;
            return $matakuliah->jenis_matakuliah == 'A' ? $matakuliah->total_sks * 2 : $matakuliah->total_sks * 1;
        });

        // Tampilkan halaman preview KRS
        return view('export.export-krs', compact('krs'));
    }

}
