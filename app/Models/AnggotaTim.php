<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnggotaTim extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'anggota_tim';
    protected $fillable = [
        'nama',
        'registrasi_id',
        'tim_id',
    ];
    protected $guarded = [];
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
    public function periode(): HasMany
    {
        return $this->hasMany(Periode::class, 'anggota_tim_id');
    }
}
