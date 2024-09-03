<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\MahasiswaDetail;
use App\Models\MahasiswaWali;
use App\Models\MahasiswaWaliDetail;
use Illuminate\Support\Facades\Session;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

class MahasiswaController extends Controller
{
    public function index()
    {
        // Mengambil data mahasiswa dari mahasiswa yang login
        $mahasiswa = Mahasiswa::where('id', Session::get('mahasiswa_id'))->first();

        // Mengambil data KTP dari relasi mahasiswa
        $ktp = $mahasiswa->ktp;
        $waliCollection = $mahasiswa->id;
        // $krs = Krs::where('mahasiswa_id', $waliCollection)->get();

        // Mengambil detail mahasiswa jika ada
        $mhsDetail = MahasiswaDetail::where('mahasiswa_id', $waliCollection)->latest()->get();

        // Contoh mengambil wali pertama, jika ada
        $wali1 = MahasiswaWali::where('mahasiswa_id', $waliCollection)
            ->where('status_kewalian', 'AYAH')
            ->first();

        $wali2 = MahasiswaWali::where('mahasiswa_id', $waliCollection)
            ->where('status_kewalian', 'IBU')
            ->first();

        // mengambil detail wali jika ada
        $wali1Detail = MahasiswaWaliDetail::where('mahasiswa_wali_id', $wali1->id)->latest()->get();
        $wali2Detail = MahasiswaWaliDetail::where('mahasiswa_wali_id', $wali2->id)->latest()->get();

        // Mendapatkan data provinsi, kota/kabupaten, kecamatan, dan kelurahan/desa dari relasi KTP
        $province = $ktp->province;
        $city = $ktp->city;
        $district = $ktp->district;
        $village = $ktp->village;

        if ($wali1) {
            $wali1province = $wali1->ktp->province;
            $wali1city = $wali1->ktp->city;
            $wali1district = $wali1->ktp->district;
            $wali1village = $wali1->ktp->village;
        }

        if ($wali2) {
            $wali2province = $wali2->ktp->province;
            $wali2city = $wali2->ktp->city;
            $wali2district = $wali2->ktp->district;
            $wali2village = $wali2->ktp->village;
        }

        // Mengirim data ke view
        return view('mahasiswa.biodata', [
            'mahasiswa' => $mahasiswa,
            'ktp' => $ktp,
            'province' => $province,
            'city' => $city,
            'district' => $district,
            'village' => $village,
            'wali1' => $wali1 ?? null,
            'wali1province' => $wali1province ?? null,
            'wali1city' => $wali1city ?? null,
            'wali1district' => $wali1district ?? null,
            'wali1village' => $wali1village ?? null,
            'wali2' => $wali2 ?? null,
            'wali2province' => $wali2province ?? null,
            'wali2city' => $wali2city ?? null,
            'wali2district' => $wali2district ?? null,
            'wali2village' => $wali2village ?? null,
            'wali1Detail' => $wali1Detail ?? null,
            'wali2Detail' => $wali2Detail ?? null,
            'mhsDetail' => $mhsDetail ?? null,
            // 'krs' => $krs ?? null,
        ]);
    }

    // AJAX handlers for fetching cities, districts, and villages dynamically
    public function getCities($provinceCode)
    {
        $cities = City::where('province_code', $provinceCode)->get();
        return response()->json($cities);
    }

    public function getDistricts($cityCode)
    {
        $districts = District::where('city_code', $cityCode)->get();
        return response()->json($districts);
    }

    public function getVillages($districtCode)
    {
        $villages = Village::where('district_code', $districtCode)->get();
        return response()->json($villages);
    }
}

