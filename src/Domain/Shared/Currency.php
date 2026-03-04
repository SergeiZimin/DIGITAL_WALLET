<?php

declare(strict_types=1);

namespace Domain\Shared;

use InvalidArgumentException;

enum Currency: string
{
    case USD = 'USD';
    case EUR = 'EUR';
    case RSD = 'RSD';



    public function scale(): int
    {
        //все валюты имеют 2 знака после запятой
        return match ($this) {
            self::USD,
            self::EUR,
            self::RSD => 2,
        };
    }

    public static function fromString(string $value): self
    {
        $currency = self::tryFrom(strtoupper($value));

        if ($currency === null) {
            throw new InvalidArgumentException("Unsupported currency: {$value}");
        }

        return $currency;
    }

    public function equals(self $other): bool
    {
        return $this === $other;
    }

    public function code(): string
    {
        return $this->value;
    }
}
