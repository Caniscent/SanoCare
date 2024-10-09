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
        Schema::create('checks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('weight');
            $table->integer('height');
            $table->decimal('sugar_content', 5, 2);
            $table->unsignedBigInteger('activity_categories_id');
            $table->unsignedBigInteger('test_method_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('activity_categories_id')->references('id')->on('activity_categories')->onDelete('cascade');
            $table->foreign('test_method_id')->references('id')->on('test_method')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checks');
    }
};
