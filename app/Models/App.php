<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image_path',
        'category_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Category::class);
    }

    public function developer()
    {
        return $this->belongsTo(User::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function wishes()
    {
        return $this->hasMany(Wish::class);
    }

    public function pricehistories()
    {
        return $this->hasMany(Pricehistory::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function compradores()
    {
        return $this->belongsToMany(User::class, 'purchases');
    }
    public function deseadores()
    {
        return $this->belongsToMany(User::class, 'wishes');
    }
}
