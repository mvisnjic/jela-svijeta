<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MealTranslation;
use App\Models\Meal;
use App\Models\Language;
use Faker\Factory as Faker;
class MealSeederTranslations extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $locales = Language::pluck('locale');

        $meals = Meal::all();

        foreach ($meals as $meal){

            foreach($locales as $locale){

                MealTranslation::create([
                    'meal_id' => $meal->id,
                    'locale' => $locale,
                    'title' => $this->randTitle($locale, $meal->id),
                    'description' => $faker->word,
                ]);
            }
        }
    }
    private function randTitle($locale, $meal_number){
        if($locale === 'en'){
            return 'Title of a meal ' . $meal_number . ' on ' . $locale . ' language';
        }
        elseif($locale === 'hr'){
            return 'Naslov jela ' . $meal_number . ' na ' . $locale . ' jeziku';
        }
        elseif($locale === 'de'){
            return 'Titel einer Mahlzeit ' . $meal_number . ' in der ' . $locale . ' sprache';
        }
        else{
            return 'título de una comida ' . $meal_number . ' en el ' . $locale . ' idioma';

        }
    }
}

