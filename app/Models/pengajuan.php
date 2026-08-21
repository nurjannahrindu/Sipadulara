<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengajuan extends Model
{
    protected $table = 'pengajuan';

    protected $primaryKey = 'id_pengajuan';

    protected $fillable = [
        'id_masyarakat',
        'id_kategori',
        'judul',
        'keterangan',
        'lokasi',
        'latitude',
        'longitude',
        'gambar',
        'tanggal',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Pengajuan milik masyarakat.
     */
    public function masyarakat(): BelongsTo
    {
        return $this->belongsTo(
            Masyarakat::class,
            'id_masyarakat',
            'id_masyarakat'
        );
    }

    /**
     * Pengajuan memiliki kategori.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(
            Kategori::class,
            'id_kategori',
            'id_kategori'
        );
    }

    /**
     * Pengajuan memiliki banyak penanganan.
     */
    public function penanganans(): HasMany
    {
        return $this->hasMany(
            Penanganan::class,
            'id_pengajuan',
            'id_pengajuan'
        );
    }
}