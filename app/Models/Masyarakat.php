<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Masyarakat extends Authenticatable
{
    use Notifiable;

    protected $table = 'masyarakat';

    protected $primaryKey = 'id_masyarakat';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'address',
        'no_hp',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function pengajuans(): HasMany
    {
        return $this->hasMany(
            Pengajuan::class,
            'id_masyarakat',
            'id_masyarakat'
        );
    }
}