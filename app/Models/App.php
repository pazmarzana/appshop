<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;

    public function categoria()
    {
        return $this->belongsTo(Category::class);
    }

    public function developer()
    {
        return $this->belongsTo(User::class);
    }

    // public function buyers()
    // {
    //     return $this->belongsToMany(User::class)->using(Purchase::class);
    // }

    // public function wishowners()
    // {
    //     return $this->belongsToMany(User::class)->using(Wish::class);
    // }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
    public function wishes()
    {
        return $this->hasMany(Wish::class);
    }
}
