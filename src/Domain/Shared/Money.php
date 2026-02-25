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
        $this->validateAmount($amount, $currency);

        $this->amount = $this->normalizeAmount($amount);

        $this->currency = $currency;

        // Валидация
        // Нормализация
        // Присвоение
    }

    /*
     |--------------------------------------------------------------------------
     | Arithmetic
     |--------------------------------------------------------------------------
     */

    public function add(Money $other): Money
    {
        // Проверка валюты
        // Сложение
        // Возврат нового Money
    }

    public function subtract(Money $other): Money
    {
        // Проверка валюты
        // Вычитание
        // Возврат нового Money
    }

    /*
     |--------------------------------------------------------------------------
     | Comparison
     |--------------------------------------------------------------------------
     */

    public function equals(Money $other): bool
    {
        // Сравнение суммы и валюты
    }

    public function greaterThan(Money $other): bool
    {
        // Проверка валюты
        // Сравнение
    }

    public function lessThan(Money $other): bool
    {
        // Проверка валюты
        // Сравнение
    }

    /*
     |--------------------------------------------------------------------------
     | State checks
     |--------------------------------------------------------------------------
     */

    public function isZero(): bool
    {
    }

    public function isPositive(): bool
    {
    }

    public function isNegative(): bool
    {
    }

    /*
     |--------------------------------------------------------------------------
     | Getters
     |--------------------------------------------------------------------------
     */

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    /*
     |--------------------------------------------------------------------------
     | Internal helpers
     |--------------------------------------------------------------------------
     */

    private function assertSameCurrency(Money $other): void
    {
        // Бросить CurrencyMismatchException
    }

    private function validateAmount(string $amount): void
    {
        // Проверка формата
        // Проверка scale
    }

    private function normalizeAmount(string $amount): string
    {
        // Приведение к виду 100.00
    }
}
