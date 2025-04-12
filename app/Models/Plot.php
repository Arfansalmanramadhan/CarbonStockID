<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Plot extends Model
{
    use HasFactory, Sluggable;
    protected $table = 'plot';
    protected $fillable = [
        'hamparan_id',
        'nama_plot',
        'slug',
        'type_plot',
        'latitude',
        'longitude',
        'status',
        'deleted_at',
    ];
    protected $guarded = [];
    protected static function boot()
    {
        parent::boot();

        // Generate slug setiap kali model diperbarui atau disimpan
        static::saving(function ($model) {
            $model->slug = Str::slug($model->nama_plot);
        });
        // static::deleting(function ($plot) {
        //     foreach ($plot->subplot as $subplots) {
        //         $plot->isForceDeleting() ? $subplots->forceDelete() : $subplots->delete();
        //     }
        // });

        // static::restoring(function ($plot) {
        //     $plot->subplot()->withTrashed()->restore();
        // });
    }
    /**
     * Get the profil that owns the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hamparan()
    {
        return $this->belongsTo(Hamparan::class, 'hamparan_id',  'id');
    }
    public function subplot()
    {
        return $this->hasMany(SubPlot::class, 'plot_id', 'id');
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
