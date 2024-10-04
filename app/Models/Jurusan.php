<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jurusan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'm_jurusan';

    // protected $fillable = [
    //     'kode_jurusan',
    //     'nama_jurusan',
    // ];

    public function programStudi()
    {
        return $this->hasMany(ProgramStudi::class, 'jurusan_id', 'id');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'jurusan_id', 'id');
    }
}
