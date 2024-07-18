<?php

namespace Database\Factories;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OfferFactory extends Factory
{
    protected $model = Offer::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'external_id' => $this->faker->randomNumber(),
            'car_brand_id' => $this->faker->randomNumber(),
            'car_model_id' => $this->faker->randomNumber(),
            'car_generation_id' => $this->faker->randomNumber(),
            'year' => $this->faker->randomNumber(),
            'run' => $this->faker->randomNumber(),
            'car_color_id' => $this->faker->randomNumber(),
            'car_body_type_id' => $this->faker->randomNumber(),
            'car_engine_type_id' => $this->faker->randomNumber(),
            'car_transmission_type_id' => $this->faker->randomNumber(),
            'car_gear_type_id' => $this->faker->randomNumber(),
            'external_generation_id' => $this->faker->randomNumber(),
        ];
    }
}
