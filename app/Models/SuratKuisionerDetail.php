<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKuisionerDetail extends Model
{
    use HasFactory;

    //table = t_request_surat_detail
    protected $table = 't_request_surat_detail';

    protected $fillable = [
        'id',
        'request_surat_id',
        'nama',
        'nip',
        'pangkat',
        'instansi',
    ];

    public function requestSurat()
    {
        return $this->belongsTo(SuratKuisioner::class, 'request_surat_id');
    }
}
