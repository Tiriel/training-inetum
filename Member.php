<?php

class Member extends User implements AuthInterface
{
    protected static int $instances = 0;

    public function __construct(
        string $name,
        protected readonly string $login,
        protected readonly string $password,
        protected readonly int $age,
    )
    {
        parent::__construct($name);
        static::$instances++;
    }

    public function __destruct()
    {
        static::$instances--;
    }

    public function auth(string $login, string $password): bool
    {
        if ($login !== $this->login || $password !== $this->password) {
            throw new AuthenticationException('Authentication Failed!');
        }

        return true;
    }

    public static function count(): int
    {
        return static::$instances;
    }
}
