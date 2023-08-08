<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoryTranslation;
use App\Models\Category;
use App\Models\Language;

class CategorySeederTranslations extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locales = Language::pluck('locale');

        $categories = Category::all();

        foreach ($categories as $category){

            foreach($locales as $locale){
                CategoryTranslation::create([
                    'category_id' => $category->id,
                    'locale' => $locale,
                    'title' => $this->randTitle($locale, $category->id),
                ]);
            }
        }
    }

    private function randTitle($locale, $category_number){
        if($locale === 'en'){
            return 'Title of category ' . $category_number . ' on ' . $locale . ' language';
        }
        elseif($locale === 'hr'){
            return 'Naslov kategorije ' . $category_number . ' na ' . $locale . ' jeziku';
        }
        elseif($locale === 'de'){
            return 'Titel der Kategorie ' . $category_number . ' in der ' . $locale . ' sprache';
        }
        else{
            return 'Título de la categoría ' . $category_number . ' en el ' . $locale . ' idioma';

        }
    }
}
