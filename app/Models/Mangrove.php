<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Mangrove extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'mangrove';
    protected $fillable = [
        'subplot_id',
        'jenis_tanaman',
        'diameter',
        'jumlah_tanaman',
        'biomasa',
        'kandungan_karbon',
        'karbondioksida'
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
