<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeBeasiswa extends Model
{
    use HasFactory;

    protected $table = 'periode_beasiswa';
    protected $primaryKey = 'id_periode';
    public $incrementing = false; // Assuming id_periode is not auto-incrementing
    protected $keyType = 'string'; // Assuming id_periode is a string
    protected $fillable = [
        'id_beasiswa',
        'tahun_ajaran',
        'triwulan',
        'start_date',
        'end_date',
    ];

    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class, 'id_beasiswa');
    }
}
