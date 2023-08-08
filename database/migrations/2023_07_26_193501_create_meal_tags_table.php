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
        Schema::create('meal_tags', function (Blueprint $table) {
            $table->bigInteger('tags_id');
            $table->bigInteger('meal_id');

            $table->foreign('tags_id')->references('id')->on('tags')->onDelete('cascade');
            $table->foreign('meal_id')->references('id')->on('meal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_tags');
    }
};
