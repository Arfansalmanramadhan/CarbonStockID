<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Symfony\Component\HttpFoundation\ServerBag;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PoltArea extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = 'polt-area';
    protected $fillable = [
        'profil_id',
        'daerah',
        "slug",
        'latitude',
        'longitude',
    ];
    /**
     * Get the profil that owns the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profil(): BelongsTo
    {
        return $this->belongsTo(Profil::class, 'profil_id');
    }
    public function semai(): BelongsTo
    {
        return $this->belongsTo(Semai::class, 'polt-area_id');
    }
    public function serasah(): BelongsTo
    {
        return $this->belongsTo(Serasah::class, 'polt-area_id');
    }
    public function tumbuhanbawah(): BelongsTo
    {
        return $this->belongsTo(TumbuhanBawah::class, 'polt-area_id');
    }
    public function tanah(): BelongsTo
    {
        return $this->belongsTo(Tanah::class, 'polt-area_id');
    }
    public function pancang(): BelongsTo
    {
        return $this->belongsTo(Pancang::class, 'polt-area_id');
    }
    public function tiang(): BelongsTo
    {
        return $this->belongsTo(Tiang::class, 'polt-area_id');
    }
    public function pohon(): BelongsTo
    {
        return $this->belongsTo(Pohon::class, 'polt-area_id');
    }
    public function necromass(): BelongsTo
    {
        return $this->belongsTo(Necromass::class, 'polt-area_id');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'daerah'
            ]
        ];
    }
}
