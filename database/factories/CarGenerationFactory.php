<?php

namespace Database\Factories;

use App\Models\CarGeneration;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CarGenerationFactory extends Factory
{
    protected $model = CarGeneration::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'generation' => $this->faker->word(),
            'car_model_id' => $this->faker->randomNumber(),
            'car_brand_id' => $this->faker->randomNumber(),
        ];
    }
}
