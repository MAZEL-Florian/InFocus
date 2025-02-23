<?php

namespace Database\Factories;

use App\Models\Mount;
use Illuminate\Database\Eloquent\Factories\Factory;

class MountFactory extends Factory
{
    protected $model = Mount::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
