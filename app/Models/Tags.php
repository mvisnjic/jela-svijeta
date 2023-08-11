<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tags extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    protected $table = 'tags';
    public $timestamps = true;
    public $translatedAttributes = ['title'];
    protected $fillable = ['slug'];

    public function meals(): BelongsToMany
    {
        return $this->belongsToMany(Meal::class, 'meal_tags', 'tags_id', 'meal_id')->withTrashed();
    }

}
