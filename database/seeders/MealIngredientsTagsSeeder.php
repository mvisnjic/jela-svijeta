<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingredients;
use App\Models\MealIngredients;
use App\Models\Tags;
use App\Models\MealTags;
use App\Models\Meal;

class MealIngredientsTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredients_count = Ingredients::count();
        $tags_count = Tags::count();

        $meals = Meal::all();

        foreach($meals as $meal){
            $number_of_tags = rand(1,10);
            $number_of_ingredients = rand(1,10);

            for($i = 0; $i <= $number_of_tags; $i++){
                MealTags::create([
                    'tags_id' => rand(1, $tags_count),
                    'meal_id' => $meal->id
                ]);
            }
            for($i = 0; $i <= $number_of_ingredients; $i++){
                MealIngredients::create([
                    'ingredients_id' => rand(1, $ingredients_count),
                    'meal_id' => $meal->id
                ]);
            }

        }
    }
}
