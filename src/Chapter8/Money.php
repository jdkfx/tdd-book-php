<?php

declare(strict_types=1);

namespace App\Chapter8;

abstract class Money
{
    /**
     * @var int
     */
    protected int $amount;

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
        return new Dollar($amount);
    }

    /**
     * @param int $amount
     * @return Money
     */
    public static function franc(int $amount): Money
    {
        return new Franc($amount);
    }
}