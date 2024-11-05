<?php

namespace App\Http\Controllers;

use App\Models\JawabanKuisioner;
use App\Models\KuisionerAkademik;
use Illuminate\Http\Request;

class KuisionerAkademikController extends Controller
{
    public function index()
    {
        $kuisioner = KuisionerAkademik::all();
        // Logika untuk memeriksa apakah mahasiswa sudah mengisi kuisioner
        $jawaban = JawabanKuisioner::where('mahasiswa_id', auth()->user()->id)->get();
        dd($jawaban);


        return view('surat&kuisioner.kuisioner-akademik', compact('kuisioner', 'jawaban'));
    }

    private function checkIfFilled($mahasiswaId)
    {
        // Logika untuk memeriksa apakah mahasiswa sudah mengisi kuisioner
        // Misalnya, Anda bisa mencari di tabel yang menyimpan jawaban kuisioner
        return JawabanKuisioner::where('mahasiswa_id', $mahasiswaId)->exists();
    }

    public function submit(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'jawaban.*' => 'required|string|max:50',
        ]);

        foreach ($validated['jawaban'] as $kuisionerId => $jawaban) {
            JawabanKuisioner::updateOrCreate(
                ['kuisioner_id' => $kuisionerId, 'mahasiswa_id' => auth()->user()->id],
                ['jawaban' => $jawaban]
            );
        }

        return redirect()->back()->with('success', 'Jawaban berhasil disimpan.');
    }
}
