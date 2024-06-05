<?php

return array(
  'name' => 'Note',
  'slug' => 'note',
  'prefix' => 'note',
  'ui' => 'bootstrap',
  'layout' => 'master',
  'theme' => 'default',
  'web' =>
  array(
    'theme' => '',
    'prefix' => 'note',
  ),
  'entities' =>
  array(
    0 => 'Modules\\Note\\Models\\NoteContent',
    1 => 'Modules\\Note\\Models\\NoteMeta',
  ),
  'navbar' =>
  array(),
  'admin' =>
  array(
    'sidebar' =>
    array(
      0 =>
      array(
        'path' => '/note',
        'title' => 'Note',
        'icon' => 'fas fa-layer-group',
        'slug' => '',
        'children' =>
        array(
          0 =>
          array(
            'path' => '/contents',
            'title' => 'Contents',
            'children' =>
            array(
              0 =>
              array(
                'path' => '/insert',
                'title' => '新增',
                'visible' => false,
              ),
              1 =>
              array(
                'path' => '/0',
                'title' => '详情',
                'visible' => false,
              ),
            ),
          ),
          1 =>
          array(
            'path' => '/config',
            'title' => 'Config',
          ),
        ),
      ),
    ),
    'prefix' => NULL,
  ),
  'controllers' =>
  array(
    0 => '\\Modules\\Note\\Http\\Controllers\\NoteController',
  ),
  'seeds' =>
  array(
    0 => '\\Modules\\Note\\Database\\Seeders\\NoteDatabaseSeeder',
  ),
  'models' =>
  array(
    0 => '\\Modules\\Note\\Models\\NoteContent',
    1 => '\\Modules\\Note\\Models\\NoteMeta',
    2 => '\\Modules\\Note\\Models\\NoteRelationship',
  ),
  'factories' =>
  array(),
  'migrations' =>
  array(
    0 => '\\Modules\\Note\\Database\\Migrations\\2024_00_00_000000_create_contents_table',
    1 => '\\Modules\\Note\\Database\\Migrations\\2024_00_00_000000_create_metas_table',
  ),
  'components' =>
  array(),
  'component-views' =>
  array(),
  'layouts' =>
  array(
    0 => '\\Modules\\Note\\Resources\\views\\layouts\\master.blade',
    1 => '\\Modules\\Note\\Resources\\views\\layouts\\web.blade',
  ),
  'api' =>
  array(
    'prefix' => 'note',
  ),
  'db' =>
  array(
    'prefix' => 'note',
  ),
  'table' =>
  array(
    'prefix' => 'note',
  ),
  'component' => NULL,
);
