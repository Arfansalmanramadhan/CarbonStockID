<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Serasah extends Model
{
    use HasFactory;
    protected $table = "serasah";
    protected $fillable = [
        "polt-area_id",
        'total_berat_basah',
        'sample_berat_basah',
        'total_berat_kering',
        'sample_berat_basah',
        'kandungan_karbon',
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