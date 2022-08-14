<?php

declare(strict_types=1);

namespace App\Chapter9;

class Dollar extends Money
{
    /**
     * @param int $amount
     * @param string $currency
     */
    public function __construct(int $amount, string $currency)
    {
        parent::__construct($amount, $currency);
    }

    /**
     * @param int $multiplier
     * @return Money
     */
    public function times(int $multiplier): Money
    {
        return Money::dollar($this->amount * $multiplier);
    }
}