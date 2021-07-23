<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //
    protected $table = 'tbl_master_arsip_video';
    protected $guarded = [''];

    public function videos()
    {
        return $this->hasMany(Video_file::class, 'master_arsip_video_id', 'id');
    }

    public function petugas()
    {
        return $this->hasMany(Petugas::class, 'id', 'master_petugas_id');
    }
}
