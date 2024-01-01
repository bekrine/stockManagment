<?php

namespace App\Models;

use App\Models\Stock;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function stocks()
    {
        /*This part of the code is defining a one-to-many a single product can have multiple associated stock entries*/
        return $this->hasMany(Stock::class);
    }

    public function recipes()
    {
        /* Eloquent relationship defining a many-to-many relationship between Product and recipe
        The withPivot method is used to specify additional columns in the intermediate table that joins the two models */
        return $this->belongsToMany(Recipe::class)->withPivot('quantity');
    }

}
