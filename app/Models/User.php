<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
    public function wishes()
    {
        return $this->hasMany(Wish::class);
    }
    public function appsComoDeveloper()
    {
        return $this->hasMany(App::class, 'developer');
    }
    public function calificaciones()
    {
        return $this->hasMany(Rating::class);
    }
    public function appscompradas()
    {
        return $this->belongsToMany(App::class, 'purchases');
    }
    public function appsdeseadas()
    {
        return $this->belongsToMany(App::class, 'wishes');
    }
}
