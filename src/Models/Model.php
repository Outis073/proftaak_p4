<?php
//namespace Vitae\Models;
//require_once 'vendor/autoload.php';

class Model
{
    public function get(string $attribute)
    {
        return $this->{$attribute};
    }

    public function set(string $attribute, $value)
    {
        $this->{$attribute} = $value;
    }
}