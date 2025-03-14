<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
class Periode extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'periode';
    protected $fillable = [
        'tim_id',
        'nama_periode',
        'tanggal_mulai',
        'tanggal_berakhir',
    ];
    protected $guarded = [];
    /**
     * Get the profil that owns the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function poltArea(): BelongsTo
    {
        return $this->belongsTo(PoltArea::class, 'periode_id');
    }
    public function tim(): BelongsTo
    {
        return $this->belongsTo(Tim::class, 'tim_id', 'id');
    }

}
