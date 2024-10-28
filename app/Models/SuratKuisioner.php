<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKuisioner extends Model
{
    use HasFactory;

    protected $table = 'm_request_surat'; 

    protected $fillable = [
        'id',
        'mahasiswa_id',
        'semester_id',
        'jenis_surat',
        'catatan',
        'status',
    ];
    
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
}
