<?php

namespace Database\Factories;

use App\Models\Curriculum;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurriculumFactory extends Factory
{
    protected $model = Curriculum::class;

    public function definition()
    {
        return [
            'title' => $this->faker->unique()->sentence,
            'thumbnail' => $this->faker->imageUrl(200, 200, 'education', true, 'Faker'),
            'description' => $this->faker->paragraph,
            'video_url' => $this->faker->url,
            'alway_delivery_flg' => $this->faker->boolean,
            'grade_id' => $this->faker->numberBetween(1, 12),
        ];
    }
}
