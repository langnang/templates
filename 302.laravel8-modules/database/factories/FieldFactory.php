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

        $return = [
            //
            "cid" => \App\Models\Content::inRandomOrder()->first(),
            "name" => $this->faker->randomElement(array_merge(['cids'], $moduleSlugs)),
            // "name" => $this->faker->word(),
            "type" => $this->faker->randomElement(['str', 'float', 'int', 'text', 'object']),
        ];

        switch ($return['type']) {
            case 'float':
                $return['float_value'] = '';
                break;
            case 'int':
                $return['int_value'] = '';
                break;
            case 'str':
                $return['str_value'] = '';
                break;
            case 'text':
                $return['text_value'] = '<!-- markdown -->';
                break;
            case 'object':
                $return['object_value'] = json_encode([], JSON_UNESCAPED_UNICODE);
                break;
            default:
                break;
        }

        return $return;
    }
}
