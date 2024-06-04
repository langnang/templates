<?php

return [
    'name' => 'Home',
    'nameCn' => '总览',
    'prefix' => '',
    'layout' => 'master',
    'admin_layout' => 'master',
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