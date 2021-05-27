<?php

class Model
{
    public function get(string $attribute)
    {
        return $this->{$attribute};
    }

    public function set(string $attribute, string $value)
    {
        $this->{$attribute} = $value;
    }
}