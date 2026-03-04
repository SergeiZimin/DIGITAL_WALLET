<?php

declare(strict_types=1);

namespace Domain\Wallet;

final class WalletId
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function toString(): string
    {
        return $this->value;
    }
}
