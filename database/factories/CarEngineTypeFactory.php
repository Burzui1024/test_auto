<?php

namespace Database\Factories;

use App\Models\CarEngineType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CarEngineTypeFactory extends Factory
{
    protected $model = CarEngineType::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'type' => $this->faker->word(),
        ];
    }
}
