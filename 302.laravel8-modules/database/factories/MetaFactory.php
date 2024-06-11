<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MetaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "mid" => $this->faker->randomNumber(),
            "slug" => $this->faker->slug(),
            //
            "name" => $this->faker->sentence(),
            "ico" => $this->faker->imageUrl(72, 72),
            "description" => $this->faker->sentence(),
            "type" => $this->faker->randomElement(['category', 'tag', 'collection', 'module']),
            "status" => $this->faker->randomElement(['publish', 'protect', 'private']),

            "count" => $this->faker->randomNumber(),
            "order" => $this->faker->randomNumber(),
            "parent" => $this->faker->randomNumber(),

            "created_at" => $this->faker->date() . ' ' . $this->faker->time(),
            "updated_at" => $this->faker->date() . ' ' . $this->faker->time(),
            "release_at" => $this->faker->date() . ' ' . $this->faker->time(),
            // "deleted_at" => $this->faker->date() . ' ' . $this->faker->time(),
        ];
    }
}
