<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    use HasFactory;

    protected $table = 'beasiswa';
    protected $primaryKey = 'id_beasiswa';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id_beasiswa',
        'jenis_beasiswa',
        'created_at',
        'updated_at',
    ];

    public function periodes()
    {
        return $this->hasMany(PeriodeBeasiswa::class, 'id_beasiswa');
    }

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class, 'id_beasiswa');
    }
}
