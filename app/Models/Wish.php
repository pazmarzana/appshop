<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    use HasFactory;


    public function posiblecomprador()
    {
        return $this->belongsTo(User::class);
    }

    public function app()
    {
        return $this->belongsTo(App::class);
    }
}
