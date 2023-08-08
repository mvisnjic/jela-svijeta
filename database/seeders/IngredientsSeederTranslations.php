<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IngredientsTranslation;
use App\Models\Ingredients;
use App\Models\Language;

class IngredientsSeederTranslations extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $locales = Language::pluck('locale');

        $ingredients = Ingredients::all();

        foreach ($ingredients as $ingredient){

            foreach($locales as $locale){
                IngredientsTranslation::create([
                    'ingredients_id' => $ingredient->id,
                    'locale' => $locale,
                    'title' => $this->randTitle($locale, $ingredient->id),
                ]);
            }
        }
    }
    private function randTitle($locale, $ingredient_number){
        if($locale === 'en'){
            return 'Title of the ingredient ' . $ingredient_number . ' on ' . $locale . ' language';
        }
        elseif($locale === 'hr'){
            return 'Naslov sastojka ' . $ingredient_number . ' na ' . $locale . ' jeziku';
        }
        elseif($locale === 'de'){
            return 'Der Titel der Zutat ' . $ingredient_number . ' in der ' . $locale . ' sprache';
        }
        else{
            return 'El título del ingrediente ' . $ingredient_number . ' en el ' . $locale . ' idioma';

        }
    }
}
