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
        return $this->hasMany(Stock::class);
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class)->withPivot('quantity');
    }

}
