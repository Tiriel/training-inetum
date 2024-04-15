<?php

use App\Patterns\Decorator\LoggableOmdbApiConsumer;
use App\Patterns\Decorator\OmdbApiConsumer;
use App\Patterns\Factory\AbstractUserFactory;
use App\Patterns\Proxy\CacheableOmdbApiConsumer;
use App\Patterns\Singleton\Singleton;
use App\User\Admin;
use App\User\Enum\AdminLevel;
use App\User\Member;
use Psr\Log\NullLogger;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

require __DIR__.'/vendor/autoload.php';

$cache = new FilesystemAdapter();
$consumer = new CacheableOmdbApiConsumer(
    $cache,
    new LoggableOmdbApiConsumer(
        new NullLogger(),
        new OmdbApiConsumer())
);
var_dump($consumer->fetch('t', 'Star Wars'));

//$m1 = AbstractUserFactory::create(Member::class, 'Ben','Ben', 'abcd', 36);
//$m2 = AbstractUserFactory::create(Member::class, 'Tom','Tom', 'abcd', 25);
//$a1 = AbstractUserFactory::create(Admin::class, 'Admin','Admin', 'admin', 50, AdminLevel::SuperAdmin);
//
//$m1->auth('Ben', 'abcd');
//echo Member::count()."\n";
//echo Admin::count()."\n";
//echo $m1."\n";
//
//unset($m2);
//
//echo Member::count()."\n";
//echo Admin::count()."\n";
//
//$singleton = Singleton::get();
