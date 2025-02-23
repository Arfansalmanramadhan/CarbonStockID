<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hamparan extends Model
{
    use HasFactory;
    protected $table = 'hamparan';
    protected $fillable = [
        'zona_id',
        'nama',
        'latitude',
        'longitude',
    ];
    /**
     * Get the profil that owns the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zona(): BelongsTo
    {
        return $this->belongsTo(Zona::class, 'zona_id');
    }
    public function plot(): BelongsTo
    {
        return $this->belongsTo(Plot::class, 'hamparan_id');
    }
}
