<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ingredients_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ingredients_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title', 100);

            $table->unique(['ingredients_id', 'locale']);
            $table->foreign('ingredients_id')->references('id')->on('ingredients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients_translations');
    }
};
