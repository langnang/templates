<?php

return [
    'name' => 'Home',
    'nameCn' => '总览',
    'layout' => 'master',
    'admin_layout' => 'master',
    "api" => [],
    "web" => [],
    // Modules
    "view_index" => [
        "visible" => true,
        "modules" => [
            "Home",
            "Question",
            "Website",
        ]
    ],
];