<?php

namespace App\Http\Controllers;
use App\Models\Jadwal;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class JadwalController extends Controller
{
    public function index()
    {
        // Mengambil data mahasiswa dari mahasiswa yang login
        $mahasiswa = Mahasiswa::where('id', Session::get('mahasiswa_id'))->first();

        // Ambil krs pertama dari mahasiswa
        $krs = $mahasiswa->krs->first(); // Assuming the relationship is 'hasMany'

        // Ambil ID paket matakuliah dari krs
        $paket_matakuliah_id = $krs->paket_matakuliah_id;
        // dd($paket_matakuliah_id);

        // Ambil data jadwal dari paket matakuliah
        // $jadwal = Jadwal::where('paket_matakuliah_id', $paket_matakuliah_id)->get();

        // ambil data jadwal with details, order by jadwal_hari dan jadwal_jam_mulai dari details
        $jadwal = Jadwal::where('paket_matakuliah_id', $paket_matakuliah_id)->with(['details' => function($query) {
            $query->orderBy('jadwal_hari')->orderBy('jadwal_jam_mulai');
        }])->first();
        // dd($jadwal);

        return view('akademik.jadwal', compact('mahasiswa', 'jadwal'));
    }

}
