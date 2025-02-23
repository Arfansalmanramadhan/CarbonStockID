<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Periode extends Model
{
    use HasFactory;
    protected $table = 'periode';
    protected $fillable = [
        'anggota_tim_id',
        'nama_periode',
        'tanggal_mulai',
        'tanggal_berakhir',
    ];
    /**
     * Get the profil that owns the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function anggotaTim(): BelongsTo
    {
        return $this->belongsTo(AnggotaTim::class, 'anggota_tim_id');
    }
}
