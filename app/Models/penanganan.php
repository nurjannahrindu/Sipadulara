<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penanganan extends Model
{
    protected $table = 'penanganan';

    protected $primaryKey = 'id_penanganan';

    protected $fillable = [
        'id_admin',
        'id_pengajuan',
        'status',
        'tanggal_penanganan',
        'keterangan',
        'gambar',
    ];

    protected $casts = [
        'tanggal_penanganan' => 'date',
    ];

    /**
     * Penanganan dilakukan oleh admin.
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(
            Admin::class,
            'id_admin',
            'id_admin'
        );
    }

    /**
     * Penanganan untuk pengajuan.
     */
    public function pengajuan(): BelongsTo
    {
        return $this->belongsTo(
            Pengajuan::class,
            'id_pengajuan',
            'id_pengajuan'
        );
    }
}