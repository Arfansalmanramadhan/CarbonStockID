<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Galery extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = 'galeri';
    protected $fillable = [
        'registrasi_id',
        "tanggal",
        "nama_judul",
        'foto',
        'video',
    ];
    // Jika ada atribut yang ingin di-guard (tidak bisa diisi langsung)
    // protected $guarded = [];
    /**
     * Get the profil that owns the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registrasi_id');
    }
}
