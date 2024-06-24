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
        'jenis_beasiswa'
    ];

    protected $primaryKey = 'id_beasiswa';

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class, 'id_beasiswa');
    }
}
