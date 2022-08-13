<?php

declare(strict_types=1);

namespace App\Chapter1;

class Dollar
{
    /**
     * @var int
     */
    public int $amount;

    /**
     * @param int $amount
     */
    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @param int $multiplier
     * @return void
     */
    public function times(int $multiplier): void
    {
        $this->amount *= $multiplier;
    }
}