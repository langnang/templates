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
            // "name" => $this->faker->randomElement(array_merge(['cids'], $moduleSlugs)),
            "name" => 'module_website',
            // "name" => $this->faker->word(),
            "type" => $this->faker->randomElement(['str', 'float', 'int', 'text', 'object']),
        ];
        switch ($return['type']) {
            case 'float':
                $return['float_value'] = $this->faker->randomFloat();
                break;
            case 'int':
                $return['int_value'] = $this->faker->randomNumber();
                break;
            case 'str':
                $return['str_value'] = $this->faker->sentence();
                break;
            case 'text':
                $return['text_value'] = '<!-- markdown -->' . $this->faker->sentence();
                break;
            case 'object':
                $return['object_value'] = json_encode([
                    'uuid' => $this->faker->uuid(),
                ], JSON_UNESCAPED_UNICODE);
                break;
            default:
                break;
        }


        switch ($return['name']) {
            case 'module_audio':
                $return['type'] = 'object';
                $return['object_value'] = [];
                break;
            case 'module_awesome':
                $return['type'] = 'text';
                $return['text_value'] = '<!-- markdown -->\r\n';
                break;
            case 'module_cheatsheet':
                $return['type'] = 'text';
                $return['text_value'] = '<!-- markdown -->\r\n';
                break;
            case 'module_novel':
                $return['type'] = 'object';
                $return['object_value'] = [];
                break;
            case 'module_video':
                $return['type'] = 'object';
                $return['object_value'] = [
                ];
                break;
            case 'module_website':
                $return['type'] = 'object';
                $return['object_value'] = [
                    'title' => $this->faker->sentence(),
                    'url' => $this->faker->url(),
                    'ico' => $this->faker->imageUrl(64, 64),
                    'keywords' => $this->faker->words(),
                    'description' => $this->faker->paragraph(),
                ];
                break;
            case 'module_spider':
                $return['type'] = 'object';
                $return['object_value'] = [
                    "export" => substr($this->faker->randomElement($moduleSlugs), 7),
                    "module" => substr($this->faker->randomElement($moduleSlugs), 7),
                    'find' => [
                        'url' => '',
                        'groups' => '',
                    ],
                    'hunt' => [
                        'url' => '',
                    ],
                    'detail' => [],
                    'chapter' => [],
                    'episode' => []
                ];
                break;
            default:
                break;
        }


        return $return;
    }
}
