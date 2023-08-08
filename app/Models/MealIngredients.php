<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealIngredients extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'meal_ingredients';
    protected $fillable = ['ingredients_id', 'meal_id'];
}
