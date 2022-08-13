<?php

declare(strict_types=1);

namespace App\Chapter3;

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
     * @return Dollar
     */
    public function times(int $multiplier): Dollar
    {
        return new Dollar($this->amount * $multiplier);
    }

    /**
     * @param Dollar $dollar
     * @return bool
     */
    public function equals(Dollar $dollar): bool
    {
        return $this->amount === $dollar->amount;
    }
}