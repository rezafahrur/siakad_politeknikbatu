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


    public function cetakPDF()
    {
        // Ambil data KRS sesuai mahasiswa_id
        $krs = Krs::where('mahasiswa_id', Session::get('mahasiswa_id'))->get();

        // Buat view PDF
        $pdf = Pdf::loadView('export.export-krs', compact('krs'));

        $namaFile = 'KRS_' . Session::get('nama') . '.pdf';

        // Unduh PDF dengan nama file KRS_NAMA_MAHASISWA.pdf
        return $pdf->download($namaFile);
    }

    // public function exportPdf()
    // {
    //     // Ambil data KRS dari database
    //     $krs = \App\Models\KRS::with(['paketMatakuliah.paketMatakuliahDetail.matakuliah'])->get();

    //     // Load view ke dalam PDF
    //     $pdf = PDF::loadView('krs.export', compact('krs'));

    //     // Download PDF
    //     return $pdf->download('krs_mahasiswa.pdf');
    // }
}
