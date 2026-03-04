<?php

declare(strict_types=1);

namespace Domain\Shared\Exception;

use Domain\Shared\Currency;

final class InvalidMoneyAmountException extends \DomainException
{
    public static function invalidFormat(string $amount): self
    {
        return new self("Invalid money format: {$amount}");
    }

    public static function invalidScale(string $amount, Currency $currency): self
    {
        return new self(
            "Invalid scale for {$currency->value}. Amount given: {$amount}"
        );
    }
}
