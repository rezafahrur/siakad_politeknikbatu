<?php

namespace App\Http\Controllers;
use App\Models\Krs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class KrsController extends Controller
{
    public function index()
    {
        // get krs sesuai mahasiswa_id dari id m_mahasiswa yang login
        $krs = Krs::where('mahasiswa_id', Session::get('mahasiswa_id'))->get();

        // dd($krs);

        return view('akademik.krs', compact('krs'));
    }
}
