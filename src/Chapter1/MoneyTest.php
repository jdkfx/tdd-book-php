<?php

declare(strict_types=1);

namespace App\Chapter1;

use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    /**
     * @return void
     */
    public function testMultiplication(): void
    {
        $five = new Dollar(5);
        $five->times(2);

        $this->assertEquals(10, $five->amount);
    }
}