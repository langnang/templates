<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            "title" => $this->faker->sentence(),
            "text" => $this->faker->text(),
            "type" => $this->faker->randomElement(['draft-post', 'post', 'draft-page', 'page', 'draft-template', 'template']),
            "status" => $this->faker->randomElement(['publish']),
        ];
    }
}
