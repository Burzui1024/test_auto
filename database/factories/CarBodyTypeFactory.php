<?php

namespace Database\Factories;

use App\Models\CarBodyType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CarBodyTypeFactory extends Factory
{
    protected $model = CarBodyType::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'type' => $this->faker->word(),
        ];
    }
}
