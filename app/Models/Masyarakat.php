<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Masyarakat extends Model
{
    protected $table = 'masyarakat';

    protected $primaryKey = 'id_masyarakat';

    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'password',
        'address',
        'no_hp',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pengajuans(): HasMany
    {
        return $this->hasMany(
            Pengajuan::class,
            'id_masyarakat',
            'id_masyarakat'
        );
    }
}