<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class AnggotaTim extends Model
{
    use HasFactory;
    protected $table = 'anggota_tim';
    protected $fillable = [
        'registrasi_id',
        'tim_id',
    ];
    /**
     * Get the profil that owns the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registrasi_id');
    }
    public function tim(): BelongsTo
    {
        return $this->belongsTo(Tim::class, 'tim_id');
    }
    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class, 'anggota_tim_id');
    }
}
