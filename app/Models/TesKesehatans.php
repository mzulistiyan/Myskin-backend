<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TesKesehatans extends Model
{
    use HasFactory;
    protected $table = 'tes_kesehatan';

    protected $fillable = [
        'id_pasien',
        'diagnosa_sementara',
    ];

    public function pasien()
    {
        return $this->hasOne(Pasiens::class, 'id_pasien', 'id_pasien');
    }

    public function getCreateAtAttribute($value)
    {
        return Carbon::parse($value)->timestamp(3);
    }

    public function getUpdatedAttribute($value)
    {
        return Carbon::parse($value)->timestamp(3);
    }
}