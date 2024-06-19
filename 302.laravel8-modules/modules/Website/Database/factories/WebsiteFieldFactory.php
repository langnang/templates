<?php
namespace Modules\Website\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WebsiteFieldFactory extends \Database\Factories\FieldFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Website\Models\WebsiteField::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $return = parent::{__FUNCTION__}();
        $return['name'] = 'module_website';
        $return['type'] = 'object';
        $return['object_value'] = [
            'title' => $this->faker->sentence(),
            'url' => $this->faker->url(),
            'ico' => $this->faker->imageUrl(64, 64),
            'keywords' => $this->faker->words(),
            'description' => $this->faker->paragraph(),
        ];
        return $return;

    }
}

