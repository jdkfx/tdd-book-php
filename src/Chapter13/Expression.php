<?php

declare(strict_types=1);

namespace App\Chapter13;

interface Expression
{
    /**
     * @param string $to
     * @return Money
     */
    public function reduce(string $to): Money;
}