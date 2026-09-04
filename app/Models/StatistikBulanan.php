<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatistikBulanan extends Model
{
    protected $table = 'statistik_bulanans';

    protected $fillable = [
        'tahun',
        'bulan',
        'total_pengajuan',
        'diajukan',
        'diproses',
        'ditangani',
        'selesai',
        'ditolak',
        'persen_diajukan',
        'persen_diproses',
        'persen_ditangani',
        'persen_selesai',
        'persen_ditolak',
    ];
}