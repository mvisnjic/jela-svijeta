<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// require_once 'vendor/autoload.php';
use App\Models\Meal;
use App\Models\Category;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories_count = Category::count();

        for ($i=0; $i < rand(10, 100); $i++) {
	    	Meal::create([
                'category_id' => mt_rand(0,1) ? rand(1, $categories_count) : null
	        ]);
    	}
    }
}
