<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuisionerAkademik extends Model
{
    use HasFactory;

    protected $table = 'm_kuisioner_akademik';
    
    protected $fillable = [
        'pertanyaan_kuisioner',
        'jawaban_kuisioner',
    ];
}
