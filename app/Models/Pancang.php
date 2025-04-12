<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Pancang extends Model
{
    use HasFactory;
    protected $table = 'pancang';
    protected $fillable = [
        'subplot_id',
        'no_pohon',
        'keliling',
        'diameter',
        'nama_lokal',
        'nama_ilmiah',
        'kerapatan_jenis_kayu',
        'bio_di_atas_tanah',
        'kandungan_karbon',
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
