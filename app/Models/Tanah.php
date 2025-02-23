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
        'subplot_id',
        'kedalaman_sample',
        'berat_jenis_tanah',
        'C_organic_tanah',
        'carbongr',
        'carbonton',
        'carbonkg',
        'co2kg',
    ];
    // Jika ada atribut yang ingin di-guard (tidak bisa diisi langsung)
    protected $guarded = [];
    /**
     * Get the poltarea that owns the poltarea
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subplot(): BelongsTo
    {
        return $this->belongsTo(SubPlot::class, 'subplot_id');
    }
}
