<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MadLibPartFactory extends Factory
{
    public function definition()
    {
        return [
            'type' => fake()->word
        ];
    }
}
