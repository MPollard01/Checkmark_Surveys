<?php

namespace App\Classes;

class Request
{
    public static function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public static function getBody()
    {
        $body = [];
        if(self::getMethod() === 'get')
        {
            foreach($_GET as $key => $value)
            {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if(self::getMethod() === 'post')
        {
            foreach($_POST as $key => $value)
            {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                
            }
        }

        return $body;
    }

    public static function getJson()
    {
        if(self::getMethod() === 'post')
        {
            $json = json_decode($_POST['data']);
            return $json;
            // foreach($json as $key => $value)
            // {
                
            //     if(is_array($value)) {
            //         foreach($value as $k => $v) {
                        
            //             if(is_object($v)) {
            //                 foreach($v as $k => $v) {
            //                     echo var_dump($v);
            //                 }
            //             }
            //         }
            //     } else {
            //         echo $key . ' = ' . $value;
            //     }
            // }
        }
    }
}