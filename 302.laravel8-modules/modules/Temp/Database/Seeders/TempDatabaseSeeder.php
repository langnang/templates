<?php

namespace Modules\Temp\Database\Seeders;

use App\Support\Helpers\ModuleHelper;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class TempDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");

        // without table prefix
        // means that the current module data is stored in the default database
        if (empty(ModuleHelper::current_config('table.prefix'))) {
            echo "without table prefix" . PHP_EOL;
            // $root_meta = \App\Models\Meta::insert([
            //     'name' => ModuleHelper::current_config('name'),
            //     'type' => 'root',
            // ],);
            $exists = \App\Models\Meta::where([['name', ModuleHelper::current_config('name')], ['type', 'root']])->first();
            var_dump($exists);
        }
    }
}