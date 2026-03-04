<?php

declare(strict_types=1);

namespace Domain\Shared;

use Domain\Shared\Exception\InvalidMoneyAmountException;
use Domain\Shared\Exception\CurrencyMismatchException;

final class Money
{
    private string $amount;
    private Currency $currency;

    public function __construct(string $amount, Currency $currency)
    {
        $this->validateAmount($amount);

        $this->amount = $this->normalizeAmount($amount);
        $this->currency = $currency;
    }


    public function add(Money $other): Money
    {
        $this->assertSameCurrency($other);

        $result = bcadd($this->amount, $other->amount, 2);

        return new self($result, $this->currency);
    }

    public function subtract(Money $other): Money
    {
        $this->assertSameCurrency($other);

        $result = bcsub($this->amount, $other->amount, 2);

        return new self($result, $this->currency);
    }



    public function equals(Money $other): bool
    {
        return $this->currency === $other->currency
            && bccomp($this->amount, $other->amount, 2) === 0;
    }

    public function greaterThan(Money $other): bool
    {
        $this->assertSameCurrency($other);

        return bccomp($this->amount, $other->amount, 2) === 1;
    }

    public function lessThan(Money $other): bool
    {
        $this->assertSameCurrency($other);

        return bccomp($this->amount, $other->amount, 2) === -1;
    }

    

    public function isZero(): bool
    {
        return bccomp($this->amount, '0.00', 2) === 0;
    }

    public function isPositive(): bool
    {
        return bccomp($this->amount, '0.00', 2) === 1;
    }

    public function isNegative(): bool
    {
        return bccomp($this->amount, '0.00', 2) === -1;
    }



    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }



    private function assertSameCurrency(Money $other): void
    {
        if ($this->currency !== $other->currency) {
            throw new CurrencyMismatchException('Currencies must be the same.');
        }
    }

    private function validateAmount(string $amount): void
    {
        if (!preg_match('/^-?\d+(\.\d{1,2})?$/', $amount)) {
            throw new InvalidMoneyAmountException("Invalid amount: {$amount}");
        }
    }

    private function normalizeAmount(string $amount): string
    {
        if (strpos($amount, '.') === false) {
            return $amount . '.00';
        }

        [$integer, $decimal] = explode('.', $amount);

        if (strlen($decimal) === 1) {
            $decimal .= '0';
        }

        return $integer . '.' . $decimal;
    }
}
