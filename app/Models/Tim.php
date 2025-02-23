<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Tim extends Model
{
    use HasFactory;
    protected $table = 'tim';
    protected $fillable = [
        'registrasi_id',
        'nama',
    ];
    /**
     * Get the profil that owns the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registrasi_id');
    }public function anggotaTim(): BelongsTo
    {
        return $this->belongsTo(AnggotaTim::class, 'tim_id');
    }
    public function PlotAreaTim(): BelongsTo
    {
        return $this->belongsTo(PlotAreaTim::class, 'tim_id');
    }
}
