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
        Schema::create('car_generations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('generation');
            $table->foreignId('car_model_id')->references('id')->on('car_models')->onDelete('cascade');
            $table->foreignId('car_brand_id')->references('id')->on('car_brands')->onDelete('cascade');
            $table->index('generation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_generations');
    }
};
