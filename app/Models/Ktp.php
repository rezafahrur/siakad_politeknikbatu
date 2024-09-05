<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;

class Ktp extends Model
{
    use HasFactory;

    protected $table = 't_ktp';

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'ktp_id', 'id');
    }

    public function mahasiswaWali()
    {
        return $this->hasMany(MahasiswaWali::class, 'ktp_id', 'id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'alamat_prov_code', 'code');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'alamat_kotakab_code', 'code');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'alamat_kec_code', 'code');
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'alamat_kel_code', 'code');
    }
}
