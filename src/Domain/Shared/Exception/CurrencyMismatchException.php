<?php

declare(strict_types=1);

namespace Domain\Shared\Exception;

use Domain\Shared\Currency;

final class CurrencyMismatchException extends \DomainException
{
    public static function forCurrencies(Currency $first, Currency $second): self
    {
        return new self(
            sprintf(
                'Currency mismatch: %s and %s',
                $first->code(),
                $second->code()
            )
        );
    }
}
