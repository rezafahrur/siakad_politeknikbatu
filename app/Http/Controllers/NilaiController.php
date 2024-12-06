<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;
use App\Models\NilaiDetail;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data mahasiswa yang sedang login
        $mahasiswaId = Auth::guard('mahasiswa')->id(); // Pastikan menggunakan guard mahasiswa

        // Ambil semester dari request untuk filter
        $semester = $request->input('semester');

        // Query nilai berdasarkan mahasiswa login dan filter semester
        $nilaiDetails = NilaiDetail::with(['nilai.kelas', 'nilai.matakuliah'])
            ->where('mahasiswa_id', $mahasiswaId)
            ->when($semester, function ($query) use ($semester) {
                $query->whereHas('nilai.kelas', function ($q) use ($semester) {
                    $q->where('semester_id', $semester); // Filter berdasarkan semester_id di m_kelas
                });
            })
            ->get();

            // dd($nilaiDetails);

        // Ambil daftar semester untuk filter dropdown
        // Ambil daftar semester dari tabel m_kelas untuk filter dropdown
        $semesters = Kelas::distinct()
            ->orderBy('semester_id')
            ->pluck('semester_id');

        return view('akademik.nilai', compact('nilaiDetails', 'semesters', 'semester'));
    }
}
