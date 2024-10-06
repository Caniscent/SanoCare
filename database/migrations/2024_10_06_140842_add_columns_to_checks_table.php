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
        Schema::table('checks', function (Blueprint $table) {
            $table->unsignedBigInteger('activity_categories_id');
            $table->unsignedBigInteger('test_method_id');
            $table->decimal('sugar_content', 5, 2);

            $table->foreign('activity_categories_id')->references('id')->on('activity_categories')->onDelete('cascade');
            $table->foreign('test_method_id')->references('id')->on('test_method')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('checks', function (Blueprint $table) {
            $table->dropForeign(['activity_categories_id']);
            $table->dropForeign(['test_method_id']);

            $table->dropColumn(['activity_categories_id','test_method_id','sugar_content']);
        });
    }
};
