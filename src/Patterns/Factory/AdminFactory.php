<?php

namespace App\Patterns\Factory;

use App\User\Admin;
use App\User\Enum\AdminLevel;

class AdminFactory extends AbstractUserFactory
{
    public function getCreatedClass(): string
    {
        return Admin::class;
    }
}
