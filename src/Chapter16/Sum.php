<?php

declare(strict_types=1);

namespace App\Chapter16;

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
     * @param Expression $augend
     * @param Expression $addend
     */
    public function __construct(Expression $augend, Expression $addend)
    {
        $this->augend = $augend;
        $this->addend = $addend;
    }

    /**
     * @param Expression $addend
     * @return Expression
     */
    public function plus(Expression $addend): Expression
    {
        return new Sum($this, $addend);
    }

    /**
     * @param Bank $bank
     * @param string $to
     * @return Money
     */
    public function reduce(Bank $bank, string $to): Money
    {
        $amount = $this->augend->reduce($bank, $to)->amount() + $this->addend->reduce($bank, $to)->amount();
        return new Money($amount, $to);
    }

    /**
     * @param int $multiplier
     * @return Expression
     */
    public function times(int $multiplier): Expression
    {
        return new Sum($this->augend->times($multiplier), $this->addend->times($multiplier));
    }
}