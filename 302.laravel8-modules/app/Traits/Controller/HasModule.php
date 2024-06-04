<?php

namespace App\Traits\Controller;

trait HasModule
{
    protected $module;

    public function set_module($module)
    {
        $this->module = $module;
    }

    public function get_module()
    {
        return $this->module;
    }

    public function get_module_config()
    {
        return \Module::getCurrentConfig();
    }
}
