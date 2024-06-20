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
        'periode'
    ];

    protected $primaryKey = 'id_beasiswa';

    public function idBeasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }
}
