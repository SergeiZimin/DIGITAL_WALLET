<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use Domain\Shared\Money;
use Domain\Shared\Currency;

$money1 = new Money('100', Currency::USD);
$money2 = new Money('50', Currency::USD);

$result = $money1->add($money2);

var_dump($result->getAmount());
