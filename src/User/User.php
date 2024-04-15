<?php

namespace App\User;

use App\Trait\ToStringTrait;

abstract class User
{
    use ToStringTrait;

    public function __construct($name)
    {
        $this->name = $name;
    }
}
