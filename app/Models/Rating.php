<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = [
        'rating',
    ];

    public function app()
    {
        return $this->belongsTo(App::class);
    }

    public function calificador()
    {
        return $this->belongsTo(User::class);
    }
}
