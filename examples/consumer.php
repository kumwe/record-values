<?php

declare(strict_types=1);

require $argv[1] ?? dirname(__DIR__) . '/vendor/autoload.php';
$value = \Kumwe\Record\Value\ClientAssertedInstant::fromPortableString('2024-02-29T10:00:00Z');
if ($value->toPortableString() !== '2024-02-29T10:00:00.000000+00:00') {
    throw new RuntimeException('Temporal mismatch.');
}
echo 'Package consumer behavior passed.' . PHP_EOL;
