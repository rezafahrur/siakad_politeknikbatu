<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\MahasiswaWali;
use App\Models\SuratKuisioner;
use Illuminate\Support\Facades\DB;
use App\Models\SuratKuisionerDetail;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\SuratKuisionerRequest;

class SuratKuisionerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::where('id', Session::get('mahasiswa_id'))->first();
        $semester = Semester::latest()->first();
        
        // Retrieve all wali associated with the mahasiswa_id
        $mahasiswaWali = MahasiswaWali::where('mahasiswa_id', Session::get('mahasiswa_id'))->get();
    
        return view('surat&kuisioner.surat.index', compact('mahasiswa', 'semester', 'mahasiswaWali'));
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
        logger("Nama Wali: " . $request->input('nama'));
        logger("NIP: " . $request->input('nip'));
        logger("Pangkat: " . $request->input('pangkat'));
        logger("Instansi: " . $request->input('instansi'));
    
        DB::beginTransaction();
        try {
            // Step 1: Create SuratKuisioner entry
            $surat = new SuratKuisioner();
            $surat->mahasiswa_id = $request->input('mahasiswa_id');
            $surat->semester_id = $request->input('semester_id');
            $surat->jenis_surat = $request->input('jenis_surat');
            $surat->status = 0;
            $surat->save();
    
            // Step 2: Create SuratKuisionerDetail entry
            $suratDetail = new SuratKuisionerDetail();
            $suratDetail->request_surat_id = $surat->id; // Associate detail with surat
            // $suratDetail->mahasiswa_wali_id = $request->input('mahasiswa_wali_id'); // Ensure this is uncommented if needed
            $suratDetail->nama = $request->input('nama');
            $suratDetail->nip = $request->input('nip');
            $suratDetail->pangkat = $request->input('pangkat');
            $suratDetail->instansi = $request->input('instansi');
            $suratDetail->save();
    
            DB::commit(); // Commit the transaction
            return redirect()->route('surat.index')->with('error', 'Gagal Permintaan surat dan detail.');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback the transaction
            logger()->error("Error saat menyimpan surat atau detail: " . $e->getMessage());
            logger()->error("Stack trace: " . $e->getTraceAsString());
            
            return redirect()->back()->with('success', 'Permintaan surat dan detail berhasil disimpan.');
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
