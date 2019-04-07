<?php

namespace App\Classes;

use Illuminate\Database\Capsule\Manager as Capsule;

class ValidateRequest
{
    private static $error = [];
    private static $error_messages = [
        'string' => 'The :attribute field contains number',
        'required' => 'The :attribute field is required',
        'min' => 'The :attribute field must be :policy characters minimun',
        'max' => 'The :attribute field must be less than :policy characters',
        'mixed' => 'The :attribute field can contains letters, numbers and special characters',
        'number' => 'The :attribute field must be a number',
        'email' => 'The :attribute field must be a valid email',
        'unique' => 'The :attribute field already exists'
    ];

    public function validate(array $data, array $policies)
    {
        foreach ($data as $column => $value) {
            if (in_array($column, array_keys($policies))) {
                self::doValidation([
                    'column' => $column,
                    'value' => $value,
                    'policies' => $policies[$column]
                ]);
            }
        }
    }
    
    protected static function doValidation(array $data)
    {
        $column = $data['column'];
        $value = $data['value'];
        foreach ($data['policies'] as $rule => $policy) {
            $valid = call_user_func_array([self::class, $rule], [$column, $value, $policy]);
            if (!$valid) {
                self::setError(
                    str_replace(
                        [':attribute', ':policy', '_'],
                        [$column, $policy, ' '],
                        self::$error_messages[$rule]
                    ),
                    $column
                );
            }
        }
    }

    protected static function unique($column, $value, $policy)
    {
        if ($value !== null && !empty(trim($value))) {
            return !Capsule::table($policy)->where($column, '=', $value)->exists();
        }
        return true;
    }

    protected static function required($column, $value, $policy)
    {
        return $value !== null && !empty(trim($value));
    }

    protected static function min($column, $value, $policy)
    {
        if ($value !== null && !empty(trim($value))) {
            return strlen($value) >= $policy;
        }
        return true;
    }

    protected static function max($column, $value, $policy)
    {
        if ($value !== null && !empty(trim($value))) {
            return strlen($value) <= $policy;
        }
        return true;
    }

    protected static function email($column, $value, $policy)
    {
        if ($value !== null && !empty(trim($value))) {
            return filter_var($value, FILTER_VALIDATE_EMAIL);
        }
        return true;
    }

    protected static function mixed($column, $value, $policy)
    {
        if ($value !== null && !empty(trim($value))) {
            if (!preg_match('/^[A-Za-z0-9 _\-!#@\&€]+$/', $value)) {
                return false;
            }
        }
        return true;
    }

    protected static function string($column, $value, $policy)
    {
        if ($value !== null && !empty(trim($value))) {
            if (!preg_match('/^[A-Za-z ]+$/', $value)) {
                return false;
            }
        }
        return true;
    }
    
    protected static function number($column, $value, $policy)
    {
        if ($value !== null && !empty(trim($value))) {
            if (!preg_match('/^[0-9.]+$/', $value)) {
                return false;
            }
        }
        return true;
    }

    private static function setError($error, $key = null)
    {
        if ($key) {
            self::$error[$key][] = $error;
        } else {
            self::$error[] = $error;
        }
    }

    public function hasError()
    {
        return count(self::$error) > 0 ? true : false;
    }

    public function getErrorMessage()
    {
        return self::$error;
    }
}
