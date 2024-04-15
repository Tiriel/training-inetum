<?php

require __DIR__.'/AuthenticationException.php';
require __DIR__.'/ToStringTrait.php';
require __DIR__.'/User.php';
require __DIR__.'/AuthInterface.php';
require __DIR__.'/Member.php';
require __DIR__.'/AdminLevel.php';
require __DIR__.'/Admin.php';

$m1 = new Member('Ben','Ben', 'abcd', 36);
$m2 = new Member('Tom','Tom', 'abcd', 25);
$a1 = new Admin('Admin','Admin', 'admin', 50);

echo Member::count()."\n";
echo Admin::count()."\n";
echo $m1."\n";

unset($m2);

echo Member::count()."\n";
echo Admin::count()."\n";
