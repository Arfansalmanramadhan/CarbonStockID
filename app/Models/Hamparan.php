<?php

namespace App\Models;

use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hamparan extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;
    protected $table = 'hamparan';
    protected $fillable = [
        'zona_id',
        'nama_hamparan',
        'slug',
        'latitude',
        'longitude',
    ];
    protected $guarded = [];
    protected static function boot()
    {
        parent::boot();

        // Generate slug setiap kali model diperbarui atau disimpan
        static::saving(function ($model) {
            $model->slug = Str::slug($model->nama_hamparan);
        });
    }
    /**
     * Get the profil that owns the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zona(): BelongsTo
    {
        return $this->belongsTo(Zona::class, 'zona_id');
    }
    public function zonaa()
    {
        return $this->hasMany(Zona::class, 'hamparan_id', 'id');
    }
    public function plots() // Pakai jamak karena hasMany
{
    return $this->hasMany(Plot::class, 'hamparan_id', 'id');
}
    public function poltArea()
    {
        return $this->hasMany(PoltArea::class, 'hamparan_id', 'id');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_hamparan'
            ]
        ];
    }
}
