<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\LanguageSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\CategorySeederTranslations;
use Database\Seeders\MealSeeder;
use Database\Seeders\MealSeederTranslations;
use Database\Seeders\TagsSeeder;
use Database\Seeders\TagsSeederTranslations;
use Database\Seeders\IngredientsSeeder;
use Database\Seeders\IngredientsSeederTranslations;
use Database\Seeders\MealIngredientsTagsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // primjer kak pozvati sve seedere odavde
        $this->call([
              LanguageSeeder::class,
              CategorySeeder::class,
              CategorySeederTranslations::class,
              MealSeeder::class,
              MealSeederTranslations::class,
              TagsSeeder::class,
              TagsSeederTranslations::class,
              IngredientsSeeder::class,
              IngredientsSeederTranslations::class,
              MealIngredientsTagsSeeder::class
            ]);
    }
}
