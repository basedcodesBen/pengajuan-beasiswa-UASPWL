<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';
    protected $primaryKey = ['id_user', 'id_beasiswa', 'id_periode'];
    public $incrementing = false;
    protected $keyType = 'int'; // Use 'int' or 'string' based on your keys' actual data types

    protected $fillable = [
        'id_user',
        'id_beasiswa',
        'id_periode',
        'ipk',
        'poin_portofolio',
        'status_1',
        'status_2',
    ];

    /**
     * Override the method to set the keys for the save query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery($query)
    {
        foreach ($this->primaryKey as $pk) {
            $query->where($pk, '=', $this->getAttribute($pk));
        }

        return $query;
    }

    /**
     * Override the method to return the composite key name.
     *
     * @return array
     */
    public function getKeyName()
    {
        return $this->primaryKey;
    }

    /**
     * Override the method to get the key for the save query.
     *
     * @return array
     */
    protected function getKeyForSaveQuery()
    {
        $keys = [];
        foreach ($this->primaryKey as $pk) {
            $keys[$pk] = $this->getAttribute($pk);
        }
        return $keys;
    }

    // public function pengajuanDocs()
    // {
    //     return $this->belongsToMany(PengajuanDoc::class, 'pengajuan_pengajuan_doc', 'id_user', 'pengajuan_doc_id')
    //         ->withPivot('file_path', 'id_beasiswa', 'id_periode');
    // }

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

