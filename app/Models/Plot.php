<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Plot extends Model
{
    use HasFactory, SoftDeletes, Sluggable;
    protected $table = 'hamparan';
    protected $fillable = [
        'hamparan_id',
        'nama_plot',
        'slug',
        'type_plot',
        'latitude',
        'longitude',
    ];
    protected $guarded = [];
    protected static function boot()
    {
        parent::boot();

        // Generate slug setiap kali model diperbarui atau disimpan
        static::saving(function ($model) {
            $model->slug = Str::slug($model->nama_plot);
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
    public function subplot(): BelongsTo
    {
        return $this->belongsTo(SubPlot::class, 'plot_id');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_plot'
            ]
        ];
    }
}
