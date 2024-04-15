<?php

namespace App\Patterns\Factory;

use App\User\Member;
use App\User\User;

class MemberFactory extends AbstractUserFactory
{
    public function getCreatedClass(): string
    {
        return Member::class;
    }
}
