<?php

namespace Database\Factories;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoFactory extends Factory
{
    protected $model = Photo::class;

    public function definition()
    {
        return [
            'make'         => $this->faker->randomElement(['Canon', 'NIKON CORPORATION', 'SONY']),
            'aperture'     => 'f/' . $this->faker->randomFloat(1, 1.4, 16),
            'focal_length' => $this->faker->randomElement(['35/1', '50/1', '85/1']),
            'image_url'    => $this->faker->imageUrl(800, 600),
        ];
    }
}
