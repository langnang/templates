<?php

return [
    'name' => 'Home',
    'nameCn' => '总览',
    'layout' => 'master',
    'admin_layout' => 'master',
    "api" => [],
    "web" => [],
    // Modules
    "view_shared" => [
        'header' => [],
        'aside' => [],
        'footer' => [],
    ],
    "view_index" => [
        "visible" => true,
        "ignore_modules" => [
            "Admin",
        ],
        "fixed_modules" => [
            "Home"
        ],
    ],
];