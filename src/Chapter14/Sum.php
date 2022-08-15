<?php

declare(strict_types=1);

namespace App\Chapter14;

class Sum implements Expression
{
    /**
     * @var $augend
     */
    public $augend;

    /**
     * @var $addend
     */
    public $addend;

    /**
     * @param Money $augend
     * @param Money $addend
     */
    public function __construct(Money $augend, Money $addend)
    {
        $this->augend = $augend;
        $this->addend = $addend;
    }

    /**
     * @param Bank $bank
     * @param string $to
     * @return Money
     */
    public function reduce(Bank $bank, string $to): Money
    {
        $amount = $this->augend->amount() + $this->addend->amount();
        return new Money($amount, $to);
    }
}