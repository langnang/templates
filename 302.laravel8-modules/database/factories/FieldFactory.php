<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FieldFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $moduleSlugs = array_map(function ($moduleName) {
            return 'module_' . (config(strtolower($moduleName) . ".slug") ?? strtolower($moduleName));
        }, array_keys(\Module::all()));

        return [
            //
            "cid" => $this->faker->randomNumber(),
            "name" => $this->faker->randomElement(array_merge(['name', 'ico', 'keywords', 'description'], $moduleSlugs)),
            // "name" => $this->faker->word(),
            "type" => $this->faker->randomElement(['str_value', 'float_value', 'int_value', 'text_value', 'object_value']),
        ];
    }
}
