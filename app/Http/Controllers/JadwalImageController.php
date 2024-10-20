<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalImage;
use Illuminate\Support\Facades\Auth;

class JadwalImageController extends Controller
{
    public function index()
    {
        // get jadwal image bedasarkan krs mahasiswa yang login saat ini dan di samakan kelas_id nya
        $jadwalImage = JadwalImage::whereHas('kelas', function ($query) {
            $query->whereHas('krs', function ($query) {
                $query->where('mahasiswa_id', Auth::user()->id);
            });
        })->first();

        $path_file_jadwal = 'https://backoffice.poltekbatu.ac.id';

        return view('akademik.jadwal', compact('jadwalImage', 'path_file_jadwal'));
    }
}
