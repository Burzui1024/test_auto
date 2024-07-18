<?php

namespace Database\Factories;

use App\Models\CarTransmissionType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CarTransmissionTypeFactory extends Factory
{
    protected $model = CarTransmissionType::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'type' => $this->faker->word(),
        ];
    }
}