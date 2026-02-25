<?php

declare(strict_types=1);

namespace Domain\Shared;

enum Currency: string
{
    case USD = 'USD';
    case EUR = 'EUR';
    case RSD = 'RSD';

    /*
     |--------------------------------------------------------------------------
     | Helpers
     |--------------------------------------------------------------------------
     */

    public function scale(): int
    {
        // Для всех трёх валют пока 2 знака после запятой
    }

    public static function fromString(string $value): self
    {
        // Безопасное создание из строки
    }
}
