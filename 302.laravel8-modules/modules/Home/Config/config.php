<?php

$configs = \App\Models\Option::where([['name', 'module_home']])->first();

// dump($configs->toArray());
return array_merge([
    'name' => 'Home',
    'nameCn' => '总览',
    'prefix' => '',
    'layout' => 'master',
    'admin_layout' => 'master',
    // Modules
    "home" => [
        "index" => [
            "visible" => true,
        ]
    ],
], []);