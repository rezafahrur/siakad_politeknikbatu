<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Contracts\Session\Session;
use App\Models\Berita;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // get berita terbaru maks 3
        $berita = Berita::orderBy('created_at', 'desc')->take(3)->get();

        // get data mahasiswa yang login
        $mahasiswa = Mahasiswa::where('id', session('mahasiswa_id'))->first();

        // Atur locale ke bahasa Indonesia
        Carbon::setLocale('id');

        // Dapatkan hari saat ini
        $hari = Carbon::now()->translatedFormat('l');

        return view('dashboard', compact('berita', 'mahasiswa', 'hari'));
    }
}
