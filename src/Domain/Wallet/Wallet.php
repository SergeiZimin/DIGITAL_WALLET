<?php

declare(strict_types=1);

namespace Domain\Wallet;

use Domain\Shared\Money;
use Domain\Shared\Currency;
use Domain\Wallet\Exception\InsufficientFundsException;
use Domain\Shared\Exception\CurrencyMismatchException;

final class Wallet
{
    private WalletId $id;

    private Money $balance;

    private Currency $currency;

    private function __construct(
        WalletId $id,
        Currency $currency,
        Money $balance
    ) 
    
    {
        $this->id = $id;
        $this->currency = $currency;
        $this->balance = $balance;
    }



    public static function create(WalletId $id, Currency $currency): self
    {
        return new self(
            $id,
            $currency,
            new Money('0', $currency)
        );
    }



    public function deposit(Money $amount): void
    {
        $this->assertSameCurrency($amount);

        $this->balance = $this->balance->add($amount);
    }

    public function withdraw(Money $amount): void
    {
        $this->assertSameCurrency($amount);

        if ($this->balance->lessThan($amount)) {
            throw new InsufficientFundsException();
        }

        $this->balance = $this->balance->subtract($amount);
    }

    public function transferTo(Wallet $other, Money $amount): void
    {
        $this->withdraw($amount);
        $other->deposit($amount);
    }


    public function getId(): WalletId
    {
        return $this->id;
    }

    public function getBalance(): Money
    {
        return $this->balance;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }



    private function assertSameCurrency(Money $amount): void
    {
        if ($amount->getCurrency() !== $this->currency) {
            throw new CurrencyMismatchException();
        }
    }
}
