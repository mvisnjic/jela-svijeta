<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Meal;
use App\Models\MealTranslation;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Tags;
use App\Models\TagsTranslation;
use App\Models\MealTags;
use App\Models\Ingredients;
use App\Models\IngredientsTranslation;
use App\Models\MealIngredients;
use App\Http\Requests\MealGetRequest;
use App\Http\Resources\MealResource;

class MealController extends Controller
{
    public function deleteMeal(Meal $id)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ('DELETE' === $method) {
}
        $id->delete();
        $id->update(['status' => 'deleted']);
        return response()->json([
            "status" => 200,
            "message" => "deleted the meal_id " . $id->id
        ], 200);
    }

    public function getMeal(Meal $id)
    {
        $meal_tr = MealTranslation::where('meal_id', $id->id)->where('locale', 'hr')->first(['id', 'meal_id', 'locale', 'title', 'description']);

        $category = Meal::find($id->id)->category;
        $category_translation = $category ? CategoryTranslation::where('category_id', $category->id)->where('locale', 'hr')->first(['category_id', 'title', 'slug']) : null;
        $category_array = [
                    "id" => $category_translation ? $category_translation->category_id: null,
                    "title" => $category_translation ? $category_translation->title : null,
                    "slug" => $category ? $category->slug : null
        ];
        $tags = Meal::find($id->id)->tags;
        $tags_arr = [];
        foreach($tags as $tag){
            $tags_translation = TagsTranslation::where('tags_id', $tag->id)->where('locale', 'hr')->first(['tags_id', 'title', 'slug']);
            $tags_arr[] = [
                "id" => $tags_translation->tags_id,
                "title" => $tags_translation->title,
                "slug" => $tag->slug
            ];
        }

        $ingredients = Meal::find($id->id)->ingredients;
        $ingredients_arr = [];
        foreach($ingredients as $ingredient){
            $ingredients_translation = IngredientsTranslation::where('ingredients_id', $ingredient->id)->where('locale', 'hr')->first(['ingredients_id', 'title', 'slug']);
            $ingredients_arr[] = [
                "id" => $ingredients_translation->ingredients_id,
                "title" => $ingredients_translation->title,
                "slug" => $ingredient->slug
            ];
        }

        return response()->json([
            "status" => 200,
            "data" => [
                "id" => $id->id,
                "title" => $meal_tr->title,
                "description" => $meal_tr->description,
                "status" => $id->status,
                "category" => $category ? $category_array : null,
                "tags" => $tags_arr,
                "ingredients" => $ingredients_arr,
            ],
        ], 200);
    }

    public function getMeals(MealGetRequest $request){

        $lang_query = $request->query('lang');
        $per_page_query = $request->query('per_page');
        $with_query = $request->query('with');
        $page_query = $request->query('page');
        $tags_query = $request->query('tags');
        $category_query = $request->query('category');
        $diff_time_query = $request->query('diff_time');

        $with_category = false;
        $with_tags = false;
        $with_ingredients = false;

        $_with = preg_split ("/\,/", $with_query);

        foreach($_with as $w) {
            if($w=='category'){
                $with_category = true;
            }
            if($w=='tags'){
                $with_tags = true;
            }
            if($w=='ingredients'){
                $with_ingredients = true;
            }
        }
        if($category_query && $tags_query){
                $tags_query = null;
            }

        $query = Meal::query();

        if ($diff_time_query > 0) {
            $query->withTrashed()->where('created_at', '>', date('Y-m-d H:i:s', $diff_time_query));
        }

        if ($tags_query) {
            $query->with('tags')->whereHas('tags', function ($tagsQuery) use ($tags_query) {
                $tagsQuery->where('id', $tags_query);
            });
        }

        if ($category_query) {
            $query->with('category')->whereHas('category', function ($categoryQuery) use ($category_query) {
                $categoryQuery->where('id', $category_query);
            });
        }

        $meals = $query->paginate($perPage = $per_page_query)->withQueryString();
        $pagination_data = $meals;
        $meal_arr = [];
        foreach($meals as $meal){
            $_meal_translation = MealTranslation::where('meal_id', $meal->id)->where('locale', $lang_query)->first(['meal_id', 'title', 'description']);

            $meal_returned_data = [
                'id' => $_meal_translation->meal_id,
                'title' => $_meal_translation->title,
                'description' => $_meal_translation->description,
                'status' => $meal->status,
            ];

            if($with_category)
            {
                $category = $meal->category;
                $category_translation = ($category != null) ? CategoryTranslation::where('category_id', $category->id)->where('locale', $lang_query)->first(['category_id', 'title', 'slug']) : null;
                $category_array = [
                    "id" => $category_translation ? $category_translation->category_id: null,
                    "title" => $category_translation ? $category_translation->title : null,
                    "slug" => $category ? $category->slug : null
                ];
                $meal_returned_data['category'] = ($category_translation) ? $category_array : null;
            }
            if($with_tags){

                $tags = $meal->tags;
                foreach($tags as $tag){
                    $tags_translation = TagsTranslation::where('tags_id', $tag->id)->where('locale', $lang_query)->first(['tags_id', 'title', 'slug']);
                    $tags_arr[] = [
                        "id" => $tags_translation->tags_id,
                        "title" => $tags_translation->title,
                        "slug" => $tag->slug
                    ];
                }
                $meal_returned_data['tags'] = $tags_arr;
            }
            if($with_ingredients){

                $ingredients = $meal->ingredients;
                foreach($ingredients as $ingredient){
                    $ingredients_translation = IngredientsTranslation::where('ingredients_id', $ingredient->id)->where('locale', $lang_query)->first(['ingredients_id', 'title', 'slug']);
                    $ingredients_arr[] = [
                        "id" => $ingredients_translation->ingredients_id,
                        "title" => $ingredients_translation->title,
                        "slug" => $ingredient->slug
                    ];
                }
                $meal_returned_data['ingredients'] = $ingredients_arr;
            }
            $meal_arr[] = $meal_returned_data;
        }
        if(count($meal_arr)>0){
            return new MealResource(['data' => $meal_arr, 'pagination_data' => $pagination_data]);
        }
        else {
            return response()->json([
                "status" => "404",
                "diff_time" => $diff_time_query ? date('Y/m/d H:i:s', $diff_time_query) : date('Y/m/d H:i:s', strtotime(now())),
            ], 404, [], JSON_UNESCAPED_SLASHES);
        }
    }
}
