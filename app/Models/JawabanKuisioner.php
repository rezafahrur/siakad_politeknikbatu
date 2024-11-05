<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanKuisioner extends Model
{
    use HasFactory;

    protected $table = 't_jawaban_kuisioner';

    protected $fillable = [
        'mahasiswa_id',
        'kuisioner_id',
        'jawaban',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function kuisioner()
    {
        return $this->belongsTo(KuisionerAkademik::class);
    }
}
