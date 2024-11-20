<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pohon extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pohon';
    protected $fillable = [
        'polt-area_id',
        'keliling',
        'diameter',
        'nama_lokal',
        'nama_ilmiah',
        'kerapatan_jenis_kayu',
        'bio_di_atas_tanah',
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
