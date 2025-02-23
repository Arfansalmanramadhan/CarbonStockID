<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Plot extends Model
{
    use HasFactory;
    protected $table = 'hamparan';
    protected $fillable = [
        'hamparan_id',
        'nama_plot',
        'type_plot',
        'latitude',
        'longitude',
    ];
    /**
     * Get the profil that owns the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hamparan(): BelongsTo
    {
        return $this->belongsTo(Hamparan::class, 'hamparan_id');
    }
    public function subplot(): BelongsTo
    {
        return $this->belongsTo(SubPlot::class, 'plot_id');
    }
}
