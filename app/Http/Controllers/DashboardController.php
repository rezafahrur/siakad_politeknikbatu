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

        return view('home', compact('berita', 'mahasiswa'));
    }
}
