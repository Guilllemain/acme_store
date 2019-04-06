<?php

namespace App\Classes;

class Request
{
    /**
     * Return all requests
     *
     * @param boolean $is_array
     * @return mixed
     */
    public static function all($is_array = false)
    {
        $result = [];
        if (count($_GET) > 0) {
            $result['get'] = $_GET;
        }
        if (count($_POST) > 0) {
            $result['post'] = $_POST;
        }
        $result['file'] = $_FILES;

        return json_decode(json_encode($result), $is_array);
    }
    
    /**
     * Get specific request
     *
     * @param string $key
     * @return mixed
     */
    public static function get(string $key, $is_array = false)
    {
        $object = new static;
        $data = $object->all($is_array);
        if ($is_array) return $data[$key];
        return $data->$key;
    }

    /**
     * Check request av ailability
     *
     * @param string $key
     * @return boolean
     */
    public static function has(string $key)
    {
        return array_key_exists($key, self::all(true)) ? true : false;
    }

    /**
     * Get old data
     *
     * @param string $key
     * @param string $value
     * @return void
     */
    public static function old(string $key, string $value)
    {
        $object = new static;
        $data = $object->all();
        return isset($data->$key->$value) ? $data->$key->$value : '';
    }
    
    /**
     * Clear all requests
     *
     * @return void
     */
    public static function clear()
    {
        $_POST = [];
        $_GET = [];
        $_FILES = [];
    }
}
