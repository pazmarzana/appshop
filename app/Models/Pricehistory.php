<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricehistory extends Model
{
    use HasFactory;
    protected $fillable = [];

    public function app()
    {
        return $this->belongsTo(App::class);
    }
}
