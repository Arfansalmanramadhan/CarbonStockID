<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Beadbs extends Model
{
    use HasFactory, SoftDeletes, Sluggable;
    protected $table = 'beabbs';
    protected $fillable = [
        'hamparan_id',
        'lokasi',
        'slug',
        'zona',
        'hamparan',
        'jenis_hutan',
        'tanggal',
        'foto',
    ];
    protected $guarded = [];
    protected static function boot()
    {
        parent::boot();

        // Generate slug setiap kali model diperbarui atau disimpan
        static::saving(function ($model) {
            $model->slug = Str::slug($model->lokasi);
        });
    }
    /**
     * Get the profil that owns the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hamparan(): BelongsTo
    {
        return $this->belongsTo(Hamparan::class, 'hamparan_id');
    }
    public function plot(): BelongsTo
    {
        return $this->belongsTo(Plot::class, 'beabbs_id');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'lokasi'
            ]
        ];
    }
}
