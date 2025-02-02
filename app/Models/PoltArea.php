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
        "status"
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
        static::deleting(function ($poltArea){
            if($poltArea->isForceDeleying()){
                $poltArea->zona()->forceDelete();
                $poltArea->semai()->forceDelete();
                $poltArea->serasah()->forceDelete();
                $poltArea->tumbuhanbawah()->forceDelete();
                $poltArea->tanah()->forceDelete();
                $poltArea->pancang()->forceDelete();
                $poltArea->tiang()->forceDelete();
                $poltArea->pohon()->forceDelete();
                $poltArea->necromas()->forceDelete();

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

            }
            
        });
    }
    /**
     * Get the profil that owns the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registrasi_id');
    }
    public function zona(): BelongsTo
    {
        return $this->belongsTo(Zona::class, 'zona_id');
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
