<?php

namespace Database\Factories;

use App\Models\PhotoType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PhotoTypeFactory extends Factory
{
    protected $model = PhotoType::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'image_url'  => $this->faker->imageUrl(),
        ];
    }
}
