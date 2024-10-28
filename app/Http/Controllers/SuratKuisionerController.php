<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuratKuisionerRequest;
use App\Models\Mahasiswa;
use App\Models\Semester;
use App\Models\SuratKuisioner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SuratKuisionerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::where('id', Session::get('mahasiswa_id'))->first();
        $semester = Semester::latest()->first();

        return view('surat&kuisioner.surat.index', compact('mahasiswa', 'semester'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mahasiswa = Mahasiswa::where('id', Session::get('mahasiswa_id'))->first();

        return view('surat&kuisioner.surat.create', compact('mahasiswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        logger("Mahasiswa ID: " . $request->input('mahasiswa_id'));
        logger("Semester ID: " . $request->input('semester_id'));
        logger("Jenis Surat: " . $request->input('jenis_surat'));
    
        try {
            $surat = new SuratKuisioner();
            $surat->mahasiswa_id = $request->input('mahasiswa_id');
            $surat->semester_id = $request->input('semester_id');
            $surat->jenis_surat = $request->input('jenis_surat');
            $surat->status = 0;
    
            $surat->save();
    
            return response()->json(['success' => true, 'message' => 'Permintaan surat berhasil disimpan.']);
        } catch (\Exception $e) {
            logger()->error("Error saat menyimpan surat: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan permintaan surat.']);
        }
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(SuratKuisioner $suratKuisioner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratKuisioner $suratKuisioner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SuratKuisionerRequest $request, SuratKuisioner $suratKuisioner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratKuisioner $suratKuisioner)
    {
        //
    }
}
