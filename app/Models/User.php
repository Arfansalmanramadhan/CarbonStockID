<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'registrasi';
    protected $fillable = [
        'role_id',
        'nama',
        'username',
        'slug',
        'email',
        'password',
        'foto',
        'nip',
        'no_hp',
        'nik',
        'foto_ktp',
        // 'password_konfimasi',
    ];
    protected static function boot ()
    {
        parent::boot();
        static::saving(function($model){
            $model->slug = Str::slug($model->username);
        });
    }
    // Accessor untuk foto
    public function getFotoAttribute($value)
    {
        return $value ? 'data:image/jpeg;base64,' . base64_encode($value) : asset('/images/PersonFill.svg');
    }

    // Accessor untuk foto_ktp
    public function getFotoKtpAttribute($value)
    {
        return $value ? 'data:image/jpeg;base64,' . base64_encode($value) : null;
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $attributes = [
        "role_id" => 2,
    ];
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    //     'password' => 'hashed',
    // ];
    public function poltarea()
    {
        return $this->hasOne(PoltArea::class, 'registrasi_id');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'username'
            ]
        ];
    }
}
