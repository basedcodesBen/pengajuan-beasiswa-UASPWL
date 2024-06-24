<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    use HasFactory;
    protected $table = 'beasiswa';
    protected $fillable = [
        'id_beasiswa',
        'jenis_beasiswa',
        'created_at',
        'updated_at',
    ];
    public function periode()
    {
        return $this->belongsTo(PeriodeBeasiswa::class, 'id_periode');
    }

}
