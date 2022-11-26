<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Transaction extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'id_pasien', 'id_dokter','total_bayar', 'status_bayar', 'payment_url'
    ];

    public function pasien()
    {
        return $this->hasOne(Pasiens::class, 'id_pasien', 'id_pasien');
    }

    public function dokter()
    {
        return $this->hasOne(Dokters::class, 'id_dokter', 'id_dokter');
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