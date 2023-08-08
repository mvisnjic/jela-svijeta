<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Scout\Searchable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Models\Tags;

class Meal extends Model implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;
    use Searchable;

    protected $table = 'meal';
    public $timestamps = true;
    public $translatedAttributes = ['title', 'description'];
    protected $fillable = ['status', 'category_id'];


    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tags::class, 'meal_tags', 'meal_id', 'tags_id');
    }
    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredients::class, 'meal_ingredients', 'meal_id', 'ingredients_id');
    }
}
