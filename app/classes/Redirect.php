<?php

namespace App\Classes;

class Redirect
{
    public static function to($page)
    {
        $baseUrl = $_ENV['BASE_URL'];
        header("location: $baseUrl$page");
    }

    public static function back()
    {
        $uri = $_SERVER['REQUEST_URI'];
        header("location: $uri");
    }
}