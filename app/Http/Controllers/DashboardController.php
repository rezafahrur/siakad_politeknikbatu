<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Mahasiswa;

class DashboardController extends Controller
{
    public function index()
    {
        // get berita terbaru maksimal 3
        $berita = Berita::orderBy('created_at', 'desc')->limit(2)->get();

        // get data mahasiswa yang login
        $mahasiswa = Mahasiswa::where('id', Session::get('mahasiswa_id'))->first();
        // dd($mahasiswa);

        // Mengambil informasi akademik
        $semesterAktif = $mahasiswa->semester_aktif;
        $jumlahSks = $mahasiswa->jumlah_sks;
        $ipk = $mahasiswa->ipk;

        // Status pembayaran UKT
        $pembayaran = $mahasiswa->pembayaran;
        $statusPembayaran = $pembayaran ? $pembayaran->status : 'Belum bayar';

        // Mengambil pengumuman terbaru
        $pengumuman = Pengumuman::orderBy('tanggal', 'desc')->take(5)->get();

        return view('home', compact('berita', 'mahasiswa'));
    }
}
