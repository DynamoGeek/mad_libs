<?php

namespace Database\Factories;

use App\Models\MadLib;
use Illuminate\Database\Eloquent\Factories\Factory;

class MadLibInstanceFactory extends Factory
{
    public function definition()
    {
        $madLib = MadLib::factory()->create();
        return [
            'mad_lib_id' => $madLib->id
        ];
    }
}
