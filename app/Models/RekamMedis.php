<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;
    protected $table = 'rekam_medis';
    protected $primaryKey = 'id_rekam_medis';

    protected $fillable = [
        'id_konsultasi'
    ];

    public function konsultasi()
    {
        return $this->hasOne(Consults::class, 'id', 'id_konsultasi');
    }
}
