<?php

namespace App\Patterns\Factory;

use App\User\User;

interface UserFactoryInterface
{
    public function create(string $name, string $login, string $password, int $age): User;

    //public function getCreatedClass(): string;
}
