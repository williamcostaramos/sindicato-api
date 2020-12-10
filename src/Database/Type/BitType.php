<?php

namespace App\Database\Type;

use Cake\Database\Driver;
use Cake\Database\Type;
use PDO;

class BitType extends Type
{
    public function toPHP($value, Driver $driver)
    {
        if ($value === null) {
            return null;
        }
        return (int)$value;
    }

    public function marshal($value)
    {
        if (is_integer($value) || $value === null) {
            return $value;
        }
        return (int)$value;
    }

    public function toDatabase($value, Driver $driver)
    {
        return (int)$value;
    }

    public function toStatement($value, Driver $driver)
    {
        if ($value === null) {
            return PDO::PARAM_NULL;
        }
        return PDO::PARAM_BOOL;
    }
}