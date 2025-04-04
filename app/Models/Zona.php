<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Symfony\Component\HttpFoundation\ServerBag;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Zona extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;
    protected $table = 'zona';
    protected $fillable = [
        'polt_area_id',
        "zona",
        "slug",
        'latitude',
        'longitude',
        "jenis_hutan",
        "foto_area",
    ];
    // Jika ada atribut yang ingin di-guard (tidak bisa diisi langsung)
    protected $guarded = [];
    protected static function boot()
    {
        parent::boot();

        // Generate slug setiap kali model diperbarui atau disimpan
        static::saving(function ($model) {
            $model->slug = Str::slug($model->zona);
        });
        // static::deleting(function ($zona) {
        //     foreach ($zona->hamparan as $hamparans) {
        //         $zona->isForceDeleting() ? $hamparans->forceDelete() : $hamparans->delete();
        //     }
        // });

        // static::restoring(function ($zona) {
        //     $zona->hamparan()->withTrashed()->restore();
        // });
    }
    /**
     * Get the profil that owns the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function poltArea() : BelongsTo
    {
        return $this->belongsTo(PoltArea::class, 'polt_area_id');
    }
    public function hamparan(): BelongsTo
    {
        return $this->belongsTo(Hamparan::class, 'zona_id');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'zona'
            ]
        ];
    }
}
