<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanDoc extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_doc';
    protected $primaryKey = 'pengajuan_doc_id';

    protected $fillable = [
        'dkbs',
        'surat_rekom',
        'surat_pernyataan',
    ];

    public function pengajuans()
    {
        return $this->belongsToMany(Pengajuan::class, 'pengajuan_pengajuan_doc', 'pengajuan_doc_id', 'id_user')
            ->withPivot('file_path', 'id_beasiswa', 'id_periode');
    }
}
