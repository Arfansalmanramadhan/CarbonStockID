<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TumbuhanBawah extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "tumbuhan_bawah";
    protected $fillable = [
        "zona_id",
        'total_berat_basah',
        'sample_berat_basah',
        'sample_berat_kering',
        'total_berat_kering',
        'kandungan_karbon',
        'co2',
    ];
    // Jika ada atribut yang ingin di-guard (tidak bisa diisi langsung)
    protected $guarded = [];
    /**
     * Get the poltarea that owns the poltarea
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zona(): BelongsTo
    {
        return $this->belongsTo(Zona::class, 'zona_id');
    }
}
