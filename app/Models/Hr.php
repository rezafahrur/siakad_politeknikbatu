<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hr extends Model
{
    use HasFactory;

    protected $table = 'm_hr';

    public function ktp()
    {
        return $this->belongsTo(Ktp::class, 'ktp_id');
    }

    /**
     * Relasi dengan model Position
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function position()
    // {
    //     return $this->belongsTo(Position::class, 'position_id');
    // }

    public function hrDetail()
    {
        return $this->hasOne(HrDetail::class, 'master_hr_id');
    }

    public function jadwalDetails()
    {
        return $this->hasMany(JadwalDetail::class, 'hr_id');
    }
}
