<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
class SubPlot extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'hamparan';
    protected $fillable = [
        'plot_id',
        'nama_suplort',
        'latitude',
        'longitude',
    ];
    protected $guarded = [];
    /**
     * Get the profil that owns the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plot(): BelongsTo
    {
        return $this->belongsTo(Plot::class, 'plot_id');
    }
    public function semai(): BelongsTo
    {
        return $this->belongsTo(Semai::class, 'zona_id');
    }
    public function serasah(): BelongsTo
    {
        return $this->belongsTo(Serasah::class, 'zona_id');
    }
    public function tumbuhanbawah(): BelongsTo
    {
        return $this->belongsTo(TumbuhanBawah::class, 'zona_id');
    }
    public function tanah(): BelongsTo
    {
        return $this->belongsTo(Tanah::class, 'zona_id');
    }
    public function pancang(): BelongsTo
    {
        return $this->belongsTo(Pancang::class, 'zona_id');
    }
    public function tiang(): BelongsTo
    {
        return $this->belongsTo(Tiang::class, 'zona_id');
    }
    public function pohon(): BelongsTo
    {
        return $this->belongsTo(Pohon::class, 'zona_id');
    }
    public function necromass(): BelongsTo
    {
        return $this->belongsTo(Necromass::class, 'zona_id');
    }
    public function mangrove(): BelongsTo
    {
        return $this->belongsTo(Mangrove::class, 'zona_id');
    }
}
