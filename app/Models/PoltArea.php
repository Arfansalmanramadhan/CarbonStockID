<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Component\HttpFoundation\ServerBag;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PoltArea extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;
    protected $table = 'polt-area';
    protected $fillable = [
        'profil_id',
        'daerah',
        "slug",
        'latitude',
        'longitude',
    ];
    // Jika ada atribut yang ingin di-guard (tidak bisa diisi langsung)
    protected $guarded = [];

    // Atribut tanggal yang soft delete
    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();

        // Generate slug setiap kali model diperbarui atau disimpan
        static::saving(function ($model) {
            $model->slug = Str::slug($model->daerah);
        });
    }
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
