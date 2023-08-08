<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealTags extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'meal_tags';
    protected $fillable = ['tags_id', 'meal_id'];
}
