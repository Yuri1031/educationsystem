<?php

namespace Database\Factories;

use App\Models\DeliveryTime;
use App\Models\Curriculum;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryTimeFactory extends Factory
{
    protected $model = DeliveryTime::class;

    public function definition()
    {
        return [
            'curriculums_id' => Curriculum::factory(),
            'delivery_from' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'delivery_to' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
