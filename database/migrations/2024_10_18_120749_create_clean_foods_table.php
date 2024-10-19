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
        Schema::create('clean_foods', function (Blueprint $table) {
            $table->id();
            $table->string('food_name');
            $table->foreignId('food_group_id')->constrained()->onDelete('cascade');
            $table->foreignId('food_type_id')->constrained()->onDelete('cascade');
            $table->decimal('calorie',5,2);
            $table->decimal('protein',4,2);
            $table->decimal('fats',5,2);
            $table->decimal('carbs',4,2);
            $table->decimal('fiber',4,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clean_foods');
    }
};
