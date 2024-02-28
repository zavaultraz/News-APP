<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'title',  
        'image',
        'slug',          
        'content'
    ];
    //functionn relationship with category
    public function category() {
        //one to many relationship using belong to
        return $this->belongsTo(Category::class); 
              
}
//accesor9
public function image(): Attribute{
    return Attribute::make(
        get: fn ($value) => asset('/storage/news/' . $value), 
    );
}

    
}
