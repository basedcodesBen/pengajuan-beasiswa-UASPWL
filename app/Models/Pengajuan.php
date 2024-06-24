<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuan';
    protected $primaryKey = ['id_user', 'id_beasiswa', 'id_periode'];
    public $incrementing = false;
    protected $keyType = 'array';

    protected $fillable = [
        'id_user',
        'id_beasiswa',
        'id_periode',
        'ipk',
        'poin_portofolio',
        'status_1',
        'status_2',
    ];

    public function pengajuanDocs()
    {
        return $this->belongsToMany(PengajuanDoc::class, 'pengajuan_pengajuan_doc', 'id_user', 'pengajuan_doc_id')
            ->withPivot('file_path', 'id_beasiswa', 'id_periode');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class, 'id_beasiswa');
    }

    public function periode()
    {
        return $this->belongsTo(PeriodeBeasiswa::class, 'id_periode');
    }
}
