<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PoltArea extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = 'polt-area';
    protected $fillable = [
        'profil_id',
        'daerah',
        "slug",
        'latitude',
        'longitude',
        'ukuran_port'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'daerah'
            ]
        ];
    }
}
