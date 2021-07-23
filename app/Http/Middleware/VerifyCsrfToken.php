<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        '/barang_data',
        '/foto_data',
        '/petugas_data',
        '/video_data',
        '/video_jadi_data',
        '/kliping_data',
        '/jadwal_data',
        '/permohonan_data',
    ];
}
