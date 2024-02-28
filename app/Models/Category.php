<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'image',
        
    ];
    //function relationship with news
    public function news() {
        //one to many relationship using has many
        return $this->hasMany(News::class);  
    }
    //accessor image Category
    public function image(): Attribute{
        return Attribute::make(
            get: fn ($value) => asset('/storage/category/' . $value), 
        );
    }
}
