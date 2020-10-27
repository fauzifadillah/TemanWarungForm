<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $fillable = [
        'nama_canvaser',
        'nama_pemilik',
        'alamat_lengkap',
        'rt_rw',
        'kelurahan',
        'kecamatan',
        'kota',
        'kode_pos',
        'jenis_usaha',
        'aplikasi_chat',
        'nomor_whatsapp',
        'status_bangunan',
        'tiga_produk',
        'foto_ktp',
        'foto_bangunan'
    ];

    protected $hidden = [
        //
    ];
}
