<?php

declare(strict_types=1);

namespace App\Chapter11;

use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    /**
     * @return void
     */
    public function testMultiplication(): void
    {
        $five = Money::dollar(5);

        $this->assertTrue(Money::dollar(10)->equals($five->times(2)));
        $this->assertTrue(Money::dollar(15)->equals($five->times(3)));
    }

    /**
     * @return void
     */
    public function testEquality(): void
    {
        $this->assertTrue(Money::dollar(5)->equals(Money::dollar(5)));
        $this->assertFalse(Money::dollar(5)->equals(Money::dollar(6)));

        $this->assertFalse(Money::franc(5)->equals(Money::dollar(5)));
    }

    /**
     * @return void
     */
    public function testCurrency(): void
    {
        $this->assertSame("USD", Money::dollar(1)->currency());
        $this->assertSame("CHF", Money::franc(1)->currency());
    }
}