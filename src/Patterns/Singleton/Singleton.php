<?php

namespace App\Patterns\Singleton;

class Singleton
{
    protected static ?self $instance = null;

    final protected function __construct()
    {
    }

    final protected function __clone(): void
    {
    }

    public static function get(): static
    {
        return static::$instance
            ?? self::$instance = new static();
    }
}
