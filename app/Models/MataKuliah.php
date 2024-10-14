<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = "m_matakuliah";
    protected $primaryKey = 'id';

    protected $fillable = [
        'kode_matakuliah',
        'nama_matakuliah',
        'program_studi_id',
        'jenis_matakuliah',
        'sks_tatap_muka',
        'sks_praktek',
        'sks_praktek_lapangan',
        'sks_simulasi',
        'metode_belajar',
        'tgl_mulai_efektif',
        'tgl_akhir_efektif',
        'status',
    ];

    // Accessor for total SKS
    public function getTotalSksAttribute()
    {
        return $this->sks_tatap_muka + $this->sks_praktek + $this->sks_praktek_lapangan + $this->sks_simulasi;
    }

    // Accessor for Jam (2 x total SKS)
    public function getJamAttribute()
    {
        if ($this->jenis_matakuliah == 'A') {
            return $this->total_sks * 2;
        } elseif ($this->jenis_matakuliah == 'W') {
            return $this->total_sks * 1;
        } else {
            return $this->total_sks * 2; // Default case if needed
        }
    }
}
