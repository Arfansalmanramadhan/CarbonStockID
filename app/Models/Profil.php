<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profil extends Model
{
    use HasFactory;
    protected $table = 'profil';
    protected $fillable = [
        'registrasi_id',
        'namadepan',
        'namabelakang',
        'no_hp'
    ];

    /**
     * Get the user that owns the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registrasi_id', 'id');
    }
}
