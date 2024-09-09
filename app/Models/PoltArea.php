<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoltArea extends Model
{
    use HasFactory;
    protected $table = 'polt-area';
    protected $fillable = [
        'profil_id',
        'nama_polt',
        'jenis',
        'daerah',
        'latitude',
        'longitude',
        'ukuran_port'
    ];
}
