<?php

abstract class User
{
    use ToStringTrait;

    public function __construct($name)
    {
        $this->name = $name;
    }
}
