<?php

namespace App\Classes;

class Session
{
    /**
     * Add a new session
     *
     * @param [String] $name
     * @param [String] $value
     * @return SESSION
     * @throws Exception
     */
    public static function add(string $name, string $value)
    {
        if ($name !== '' && !empty($name) && $value != '' && !empty($value)) {
            return $_SESSION[$name] = $value;
        }

        throw new \Exception('Name and value required');
    }

    /**
     * Get value from a session
     *
     * @param [string] $name
     * @return SESSION
     */
    public static function get(string $name)
    {
        return $_SESSION[$name];
    }

    /**
     * Check if there is a session
     *
     * @param [string] $name
     * @return boolean
     * @throws Exception
     */
    public static function has(string $name)
    {
        if ($name !== '' && !empty($name)) {
            return isset($_SESSION[$name]) ? true : false;
        }

        throw new \Exception('name is required');
    }

    /**
     * Remove session
     *
     * @param [string] $name
     */
    public static function remove(string $name)
    {
        if (self::has($name)) {
            unset($_SESSION[$name]);
        }
    }
}
