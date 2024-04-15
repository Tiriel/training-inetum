<?php

class Admin extends Member
{
    protected static int $instances = 0;
    protected readonly AdminLevel $level;

    public function __construct(
        string $name,
        string $login,
        string $password,
        int $age,
        AdminLevel $level = AdminLevel::Admin
    ) {
        parent::__construct($name, $login, $password, $age);
        $this->level = $level;
    }

    public function auth(string $login, string $password): bool
    {
        if (AdminLevel::SuperAdmin === $this->level) {
            return true;
        }

        return parent::auth($login, $password);
    }
}
