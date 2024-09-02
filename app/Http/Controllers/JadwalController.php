<?php

namespace App\Http\Controllers;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class JadwalController extends Controller
{
    public function index()
    {
        // get jadwal sesuai paket_matakuliah_id dan di cocokan dengan data di krs yang karena terdapat mahasiswa_id
        $jadwal = Jadwal::where('paket_matakuliah_id', Session::get('paket_matakuliah_id'))->get();
        dd($jadwal);

        return view('akademik.jadwal', compact('jadwal'));
    }
}
