<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    //
    protected $table = 'tbl_master_peliputan';
    protected $guarded = [''];


    public function petugas()
    {
        return $this->hasMany(Petugas::class, 'id', 'master_petugas_id');
    }

    public function editors()
    {
        return $this->hasMany(Petugas::class, 'id', 'master_petugas_editor_id');
    }
}
