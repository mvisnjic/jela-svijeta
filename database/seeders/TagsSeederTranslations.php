<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TagsTranslation;
use App\Models\Tags;
use App\Models\Language;

class TagsSeederTranslations extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locales = Language::pluck('locale');

        $tags = Tags::all();

        foreach ($tags as $tag){

            foreach($locales as $locale){
                TagsTranslation::create([
                    'tags_id' => $tag->id,
                    'locale' => $locale,
                    'title' => $this->randTitle($locale, $tag->id),
                ]);
            }
        }
    }
    private function randTitle($locale, $tag_number){
        if($locale === 'en'){
            return 'Title of tag ' . $tag_number . ' on ' . $locale . ' language';
        }
        elseif($locale === 'hr'){
            return 'Naslov taga ' . $tag_number . ' na ' . $locale . ' jeziku';
        }
        elseif($locale === 'de'){
            return 'Titel tag ' . $tag_number . ' in der ' . $locale . ' sprache';
        }
        else{
            return 'Título de la etiqueta ' . $tag_number . ' en el ' . $locale . ' idioma';

        }
    }
}
