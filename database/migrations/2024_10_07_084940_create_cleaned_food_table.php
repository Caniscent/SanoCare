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
        Schema::create('cleaned_food', function (Blueprint $table) {
            $table->id();
            $table->string('ingredients_name');
            $table->string('food_group');
            $table->string('type');
            $table->integer('energy_kal');
            $table->integer('protein_g');
            $table->integer('fat_g');
            $table->integer('carbs_g');
            $table->integer('fiber_g');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cleaned_food');
    }
};
