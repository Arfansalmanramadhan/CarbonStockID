<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Necromass extends Model
{
    use HasFactory;
    protected $table = 'necromass';
    protected $fillable = [
        'subplot_id',
        'diameter_pangkal',
        'diameter_ujung',
        'panjang',
        'volume',
        'berat_jenis_kayu',
        'biomasa',
        'carbon',
        'co2',
        'deleted_at',
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
