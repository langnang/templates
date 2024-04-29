<?php

if (!function_exists('generate_ini_string')) {
    function generate_ini_string($config)
    {
        $iniString = '';
        foreach ($config as $key => $value) {
            $iniString .= sprintf("[%s]\n%s = %s\n\n", $key, $key, $value);
        }
        return $iniString;
    }
}