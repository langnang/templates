<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(5)->create();
        \App\Models\Meta::factory(30)->create();
        \App\Models\Content::factory(100)->create();
        \App\Models\Field::factory(1000)->create();
        // \App\Models\Comment::factory(100)->create();
        \App\Models\Link::factory(100)->create();
        // \App\Models\Relationship::factory(100)->create();

        // $this->call("OthersTableSeeder");

        $this->call(array_merge([OptionTableSeeder::class], array_map(function ($moduleName) {
            return "\Modules\\" . $moduleName . "\Database\Seeders\\" . $moduleName . "DatabaseSeeder";
        }, array_keys(\Module::all()))));

    }
}
