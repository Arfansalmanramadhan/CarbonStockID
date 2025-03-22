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
    protected $table = 'polt_area';
    protected $fillable = [
        'daerah',
        "slug",
        "jenis_hutan",
        'latitude',
        'longitude',
        'jenis_hutan',
        'periode_pengamatan',
        "status",
        'periode_id'
    ];
    // Jika ada atribut yang ingin di-guard (tidak bisa diisi langsung)
    protected $guarded = [];


    protected static function boot()
    {
        parent::boot();

        // Generate slug setiap kali model diperbarui atau disimpan
        static::saving(function ($model) {
            $model->slug = Str::slug($model->daerah);
        });
        static::deleting(function ($poltArea) {
            if ($poltArea->isForceDeleying()) {
                $poltArea->zona()->forceDelete();
                $poltArea->semai()->forceDelete();
                $poltArea->serasah()->forceDelete();
                $poltArea->tumbuhanbawah()->forceDelete();
                $poltArea->tanah()->forceDelete();
                $poltArea->pancang()->forceDelete();
                $poltArea->tiang()->forceDelete();
                $poltArea->pohon()->forceDelete();
                $poltArea->necromas()->forceDelete();
                $poltArea->mangrove()->forceDelete();
            } else {
                $poltArea->zona()->delete();
                $poltArea->semai()->delete();
                $poltArea->serasah()->delete();
                $poltArea->tumbuhanbawah()->delete();
                $poltArea->tanah()->delete();
                $poltArea->pancang()->delete();
                $poltArea->tiang()->delete();
                $poltArea->pohon()->delete();
                $poltArea->necromas()->delete();
                $poltArea->mangrove()->delete();
            }
        });
        static::restoring(function ($poltArea) {
            $poltArea->zona()->withTrashed()->restore();
            $poltArea->semai()->withTrashed()->restore();
            $poltArea->serasah()->withTrashed()->restore();
            $poltArea->tumbuhanbawah()->withTrashed()->restore();
            $poltArea->tanah()->withTrashed()->restore();
            $poltArea->pancang()->withTrashed()->restore();
            $poltArea->tiang()->withTrashed()->restore();
            $poltArea->pohon()->withTrashed()->restore();
            $poltArea->necromas()->withTrashed()->restore();
            $poltArea->mangrove()->withTrashed()->restore();
        });
    }
    /**
     * Get the profil that owns the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class, 'periode_id');
    }
    public function zona(): BelongsTo
    {
        return $this->belongsTo(Zona::class, 'polt_area_id', 'id');
    }
    public function PlotAreaTim(): BelongsTo
    {
        return $this->belongsTo(PlotAreaTim::class, 'polt_area_id');
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
