<?php

namespace App\Classes;

class Session
{
    public static function add($name, $value)
    {
        if($name != '' && !empty($name) && $value != '' && !empty($value)) {
            return $_SESSION[$name] = $value;
        }
    }

    public static function get($name)
    {
        return $_SESSION[$name];
    }

    public static function has($name)
    {
        if($name != '' && !empty($name)) {
            return isset($_SESSION[$name]);
        }
    }

    public static function remove($name)
    {
        if(self::has($name)) unset($_SESSION[$name]);
    }
}