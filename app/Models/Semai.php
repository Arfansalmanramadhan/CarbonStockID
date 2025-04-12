<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Semai extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = "semai";
    protected $fillable = [
        "subplot_id",
        'total_berat_basah',
        'sample_berat_basah',
        'sample_berat_kering',
        'total_berat_kering',
        'kandungan_karbon ',
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
