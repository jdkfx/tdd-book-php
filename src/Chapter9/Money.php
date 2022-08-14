<?php

declare(strict_types=1);

namespace App\Chapter9;

abstract class Money
{
    /**
     * @var int
     */
    protected int $amount;

    /**
     * @var string
     */
    protected string $currency;

    /**
     * @param int $amount
     * @param string $currency
     */
    public function __construct(int $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @param int $multiplier
     * @return Money
     */
    public abstract function times(int $multiplier): Money;

    /**
     * @param Money $money
     * @return bool
     */
    public function equals(Money $money): bool
    {
        return $this->amount === $money->amount
            && get_class($this) === get_class($money);
    }

    /**
     * @param int $amount
     * @return Money
     */
    public static function dollar(int $amount): Money
    {
        return new Dollar($amount, "USD");
    }

    /**
     * @param int $amount
     * @return Money
     */
    public static function franc(int $amount): Money
    {
        return new Franc($amount, "CHF");
    }

    /**
     * @return string
     */
    public function currency(): string
    {
        return $this->currency;
    }
}