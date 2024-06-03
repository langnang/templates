<?php

namespace Modules\Home\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class HomeDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();

        // $this->call("OthersTableSeeder");
        // $this->call([
        //     HomeMetaTableSeeder::class,
        //     HomeContentTableSeeder::class,
        // ]);

        \App\Models\Option::upsert([['name' => "module_home", "user" => 0, 'type' => 'object', "value" => serialize([])]], ['name', "user"]);
    }
}