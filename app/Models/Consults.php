<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Consults extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'id_pasien',
        'id_dokter',
        'id_transaksi',
        'diagnosa_lanjut',
        'diagnosa_sementara',
        'status_konsultasi'
    ];

    public function pasien()
    {
        return $this->hasOne(Pasiens::class, 'id_pasien', 'id_pasien');
    }

    public function dokter()
    {
        return $this->hasOne(Dokters::class, 'id_dokter', 'id_dokter');
    }

    public function transaksi()
    {
        return $this->hasOne(Transaction::class, 'id', 'id_transaksi');
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