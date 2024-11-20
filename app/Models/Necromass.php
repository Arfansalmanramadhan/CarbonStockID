<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Necromass extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'necromass';
    protected $fillable = [
        'polt-area_id',
        'diameter_pangkal',
        'diameter_ujung',
        'panjang',
        'volume',
        'berat_jenis_kayu',
        'biomasa',
        'carbon',
        'co2',
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
