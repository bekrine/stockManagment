<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function products()
    {
         /* Eloquent relationship defining a many-to-many relationship between recipe and product
        The withPivot method is used to specify additional columns in the intermediate table that joins the two models */
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
