<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
class Tim extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tim';
    protected $fillable = [
        'nama',
    ];
    protected $guarded = [];
    /**
     * Get the profil that owns the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function anggotaTim(): BelongsTo
    {
        return $this->belongsTo(AnggotaTim::class, 'tim_id');
    }
    public function PlotAreaTim(): BelongsTo
    {
        return $this->belongsTo(PlotAreaTim::class, 'tim_id');
    }
}
