<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    //
    protected $table = 'tbl_master_arsip_foto';
    protected $guarded = [''];

    public function fotos()
    {
        return $this->hasMany(Foto_file::class, 'master_arsip_foto_id', 'id');
    }

    public function petugas()
    {
        return $this->hasMany(Petugas::class, 'id', 'master_petugas_id');
    }
}
