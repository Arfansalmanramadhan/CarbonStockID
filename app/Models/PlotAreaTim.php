<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
class PlotAreaTim extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'polt_area_tim';
    protected $fillable = [
        'tim_id',
        'polt_area_id',
    ];
    protected $guarded = [];
    /**
     * Get the profil that owns the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tim(): BelongsTo
    {
        return $this->belongsTo(Tim::class, 'tim_id');
    }
    public function poltArea(): BelongsTo
    {
        return $this->belongsTo(PoltArea::class, 'polt_area_id');
    }
}
