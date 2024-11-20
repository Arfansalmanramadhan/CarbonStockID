<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tanah extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tanah';
    protected $fillable = [
        'polt-area_id',
        'kedalaman_sample',
        'berat_jenis_tanah',
        'C_organic_tanah',
        'carbongr',
        'carbonton',
        'carbonkg',
        'co2kg',
    ];
    /**
     * Get the poltarea that owns the poltarea
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function poltarea(): BelongsTo
    {
        return $this->belongsTo(PoltArea::class, 'polt-area_id');
    }
}
