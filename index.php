<?php

use App\User\Admin;
use App\User\Member;

require __DIR__.'/vendor/autoload.php';

$m1 = new Member('Ben','Ben', 'abcd', 36);
$m2 = new Member('Tom','Tom', 'abcd', 25);
$a1 = new Admin('Admin','Admin', 'admin', 50);

echo Member::count()."\n";
echo Admin::count()."\n";
echo $m1."\n";

unset($m2);

echo Member::count()."\n";
echo Admin::count()."\n";
