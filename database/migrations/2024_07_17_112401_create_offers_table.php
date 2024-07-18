<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('external_id')->unique();
            $table->foreignId('car_brand_id')->references('id')->on('car_brands')->onDelete('cascade');
            $table->foreignId('car_model_id')->references('id')->on('car_models')->onDelete('cascade');
            $table->foreignId('car_generation_id')->nullable()->references('id')->on('car_generations')->onDelete('cascade');
            $table->integer('year')->nullable();
            $table->integer('run')->nullable();
            $table->foreignId('car_color_id')->nullable()->references('id')->on('car_colors')->onDelete('cascade');
            $table->foreignId('car_body_type_id')->nullable()->references('id')->on('car_body_types')->onDelete('cascade');
            $table->foreignId('car_engine_type_id')->nullable()->references('id')->on('car_engine_types')->onDelete('cascade');
            $table->foreignId('car_transmission_type_id')->nullable()->references('id')->on('car_transmission_types')->onDelete('cascade');
            $table->foreignId('car_gear_type_id')->nullable()->references('id')->on('car_gear_types')->onDelete('cascade');
            $table->bigInteger('external_generation_id')->nullable();
            $table->index('year');
            $table->index('run');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
