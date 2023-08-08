<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    protected $table = 'category';
    public $timestamps = false;
    public $translatedAttributes = ['title'];
    protected $fillable = ['slug'];

    public function meal(): HasMany
    {
        return $this->hasMany(Meal::class, 'category_id', 'id');
    }
}
