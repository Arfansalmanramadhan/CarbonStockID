<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Component\HttpFoundation\ServerBag;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Zona extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'zona';
    protected $fillable = [
        'polt-area_id',
        "zona",
        "jenis_hutan"
    ];
    // Jika ada atribut yang ingin di-guard (tidak bisa diisi langsung)
    protected $guarded = [];

    /**
     * Get the profil that owns the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function poltArea(): BelongsTo
    {
        return $this->belongsTo(PoltArea::class, 'polt-area_id');
    }
    public function semai(): BelongsTo
    {
        return $this->belongsTo(Semai::class, 'zona_id');
    }
    public function serasah(): BelongsTo
    {
        return $this->belongsTo(Serasah::class, 'zona_id');
    }
    public function tumbuhanbawah(): BelongsTo
    {
        return $this->belongsTo(TumbuhanBawah::class, 'zona_id');
    }
    public function tanah(): BelongsTo
    {
        return $this->belongsTo(Tanah::class, 'zona_id');
    }
    public function pancang(): BelongsTo
    {
        return $this->belongsTo(Pancang::class, 'zona_id');
    }
    public function tiang(): BelongsTo
    {
        return $this->belongsTo(Tiang::class, 'zona_id');
    }
    public function pohon(): BelongsTo
    {
        return $this->belongsTo(Pohon::class, 'zona_id');
    }
    public function necromass(): BelongsTo
    {
        return $this->belongsTo(Necromass::class, 'zona_id');
    }
    
}
