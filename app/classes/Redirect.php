<?php

namespace App\Classes;

class Redirect
{
    /**
     * Redirect to specific uri
     * @params [string] $uri
     */
    public static function to($uri)
    {
        header("location: $uri");
    }

    /**
     * Redirect back
     */
    public static function back()
    {
        $uri = $_SERVER['REQUEST_URI'];
        header("location: $uri");
    }
}
