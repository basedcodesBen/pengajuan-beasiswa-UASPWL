<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeBeasiswa extends Model
{
    use HasFactory;

    protected $table = 'periode_beasiswa';

    protected $fillable = [
        'id_periode',
        'id_beasiswa',
        'tahun_ajaran',
        'triwulan',
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
    ];

    protected $primaryKey = 'id_beasiswa';

    public function idBeasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }
}
