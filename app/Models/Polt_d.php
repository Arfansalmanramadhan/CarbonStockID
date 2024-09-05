<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Polt_d extends Model
{
    use HasFactory;
    protected $table = 'polt_d';
    protected $fillable = [
        "polt_area_id",
        "jenis",
    ];
    /**
     * Get the portarea that owns the polt_a
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function portarea(): BelongsTo
    {
        return $this->belongsTo(PoltArea::class, 'polt_area_id', 'id');
    }
}
