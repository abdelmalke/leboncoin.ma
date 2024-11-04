<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   

    use HasFactory;

    
        // protected $fillable = [
        //     'title', 'description', 'price', 'location', 'area', 'type', 'image_url', 'user_id', 'status', 'category_id'
        // ];
        protected $fillable = [
            'title', 
            'description', 
            'price', 
            'location', 
            'area', 
            'type', 
            'image_url', 
            'user_id', 
            'status', 
            'category_id',
            'type_of_property', //
            'habitable_area',   //
            'in_city',          //
            'fees_included',    //
            'reference_number', //
        ];
 

    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
{
    return $this->belongsTo(Category::class);
}
public function appointments()
{
    return $this->hasMany(Appointment::class);
}

}
