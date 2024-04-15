<?php

namespace App\Patterns\Factory;

use App\User\Admin;
use App\User\Member;
use App\User\User;

class AbstractUserFactory
{
    public static function create(string $className, string $name, string $login, string $password, int $age, ...$args): User
    {
        $password = password_hash($password, PASSWORD_BCRYPT);

        return new (new $className)($name, $login, $password, $age, ...$args);
    }
}
