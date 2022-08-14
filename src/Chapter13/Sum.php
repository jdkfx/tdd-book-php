<?php

declare(strict_types=1);

namespace App\Chapter13;

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
     * @param string $to
     * @return Money
     */
    public function reduce(string $to): Money
    {
        $amount = $this->augend->amount() + $this->addend->amount();
        return new Money($amount, $to);
    }
}