<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('options')->upsert(
            [["name" => "modules", 'user' => 0, "value" => []]],
            ["name", "user"],
        );
    }
}
