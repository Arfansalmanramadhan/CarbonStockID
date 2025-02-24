<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
class Plot extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'hamparan';
    protected $fillable = [
        'zona_id',
        'nama_plot',
        'type_plot',
        'latitude',
        'longitude',
    ];
    protected $guarded = [];
    /**
     * Get the profil that owns the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zona(): BelongsTo
    {
        return $this->belongsTo(Zona::class, 'zona_id');
    }
    public function subplot(): BelongsTo
    {
        return $this->belongsTo(SubPlot::class, 'plot_id');
    }
}
