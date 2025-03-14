<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Str;
class Tim extends Model
{
    use HasFactory, SoftDeletes, Sluggable;
    protected $table = 'tim';
    protected $fillable = [
        'nama',
    ];
    protected $guarded = [];
    protected static function boot()
    {
        parent::boot();

        // Generate slug setiap kali model diperbarui atau disimpan
        static::saving(function ($model) {
            $model->slug = Str::slug($model->nama);
        });
    }
    /**
     * Get the profil that owns the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function anggotaTim(): BelongsTo
    // {
    //     return $this->belongsTo(AnggotaTim::class, 'tim_id');
    // }
    public function PlotAreaTim(): BelongsTo
    {
        return $this->belongsTo(PlotAreaTim::class, 'tim_id');
    }
    public function periode()
    {
        return $this->hasOne(Periode::class, 'tim_id', 'id');
    }
    public function anggotaTim()
    {
        return $this->hasMany(AnggotaTim::class, 'tim_id');
    }
    public function getJumlahAnggotaAttribute()
    {
        return $this->anggotaTim->whereNotNull('nama')->unique('nama')->count();
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama'
            ]
        ];
    }
}
