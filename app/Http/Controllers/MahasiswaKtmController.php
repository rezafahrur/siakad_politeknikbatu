<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\MahasiswaKtm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MahasiswaKtmController extends Controller
{
    public function index()
    {
        // Mengambil data mahasiswa dari mahasiswa yang login
        $mahasiswa = Mahasiswa::where('id', Session::get('mahasiswa_id'))->first();

        // get mahasiswa ktm yang di upload terbaru
        $mahasiswaKtm = MahasiswaKtm::where('mahasiswa_id', $mahasiswa->id)->orderBy('created_at', 'desc')->first();

        return view('general.ktm.index', compact('mahasiswa', 'mahasiswaKtm'));
    }

    public function uploadKtm(Request $request)
    {
        $request->validate([
            'cropped_image' => 'required',
        ]);

        $mahasiswa = Auth::user();

        // Handle base64 image
        $croppedImage = $request->input('cropped_image');
        list($type, $croppedImage) = explode(';', $croppedImage);
        list(, $croppedImage) = explode(',', $croppedImage);
        $croppedImage = base64_decode($croppedImage);

        $extension = '';
        if (str_contains($type, 'jpeg') || str_contains($type, 'jpg')) {
            $extension = 'jpg';
        } elseif (str_contains($type, 'png')) {
            $extension = 'png';
        }

        if ($extension === '') {
            return back()->withErrors('Unsupported image format.');
        }

        $directory = public_path('uploads/foto-ktm');
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $filename = 'KTM_' . date('Ymdhis') . '.' . $extension;
        $filePath = $directory . '/' . $filename;

        // Save the image file
        file_put_contents($filePath, $croppedImage);

        // Check if the student already has a rejected KTM (status = 0)
        $mahasiswaKtm = MahasiswaKtm::where('mahasiswa_id', $mahasiswa->id)
                                    ->where('status', 0)
                                    ->first();

        if ($mahasiswaKtm) {
            // Update the existing rejected KTM record
            $mahasiswaKtm->update([
                'path_photo' => 'uploads/foto-ktm/' . $filename,
                'status' => '1', // Set status to '1' (Pending validation)
            ]);
        } else {
            // Create a new record if no rejected KTM exists
            MahasiswaKtm::create([
                'mahasiswa_id' => $mahasiswa->id,
                'path_photo' => 'uploads/foto-ktm/' . $filename,
                'status' => '1', // Set status to '1' (Pending validation)
            ]);
        }

        return back()->with('success', 'KTM uploaded successfully and is pending for validation!');
    }


}
