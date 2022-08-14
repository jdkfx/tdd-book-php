<?php

declare(strict_types=1);

namespace App\Chapter8;

use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    /**
     * @return void
     */
    public function testMultiplication(): void
    {
        $five = Money::dollar(5);

        $this->assertEquals(Money::dollar(10), $five->times(2));
        $this->assertEquals(Money::dollar(15), $five->times(3));
    }

    /**
     * @return void
     */
    public function testEquality(): void
    {
        $this->assertTrue(Money::dollar(5)->equals(Money::dollar(5)));
        $this->assertFalse(Money::dollar(5)->equals(Money::dollar(6)));

        $this->assertTrue(Money::franc(5)->equals(Money::franc(5)));
        $this->assertFalse(Money::franc(5)->equals(Money::franc(6)));

        $this->assertFalse(Money::franc(5)->equals(Money::dollar(5)));
    }

    /**
     * @return void
     */
    public function testFrancMultiplication(): void
    {
        $five = Money::franc(5);

        $this->assertEquals(Money::franc(10), $five->times(2));
        $this->assertEquals(Money::franc(15), $five->times(3));
    }
}