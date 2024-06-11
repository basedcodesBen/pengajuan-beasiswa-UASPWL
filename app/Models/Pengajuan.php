<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';

    protected $fillable = [
        'id_pengajuan',
        'id_user',
        'id_beasiswa',
        'id_periode',
        'nrp',
        'nama',
        'ipk',
        'transkrip',
        'surat_rekom',
        'surat_pernyataan',
        'bukti_keaktifan',
        'dokum_pendukung',
        'status_approve',
    ];

    protected $primaryKey = 'id_pengajuan';

    public function idUser()
    {
        return $this->belongsTo(User::class);
    }

    public function idBeasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }

    public function idPeriode()
    {
        return $this->belongsTo(PeriodeBeasiswa::class);
    }
}
