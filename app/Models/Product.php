<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['quantity'];

    
    
    public function scopeMightAlsoLike($query)
    {
        return $query->inRandomOrder()->take(4);
    }
    
    public function presentPrice()
    {
        return '$'.number_format($this->price / 100, 2);
    }



    public function categories()
    {
       return $this->belongsToMany(Category::class);
    }
}
