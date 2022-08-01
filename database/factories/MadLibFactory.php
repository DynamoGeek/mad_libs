<?php

namespace Database\Factories;

use App\Models\MadLib;
use App\Models\MadLibPart;
use Illuminate\Database\Eloquent\Factories\Factory;

class MadLibFactory extends Factory
{
    public function definition(): array
    {
        return [
            'content' => fake()->words(3, true) . '{blank}' . fake()->words(3, true) . '{blank}' . fake()->words(3, true) . '{blank}',
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (MadLib $madLib) {
            $count = substr_count($madLib->content, '{blank}');
            $madLib->madLibParts()->saveMany(MadLibPart::factory()->count($count)->make());
        });
    }
}
