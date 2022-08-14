<?php

declare(strict_types=1);

namespace App\Chapter13;

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

    /**
     * @return void
     */
    public function testSimpleAddition(): void
    {
        $five = Money::dollar(5);
        $sum = $five->plus($five);

        $bank = new Bank();
        $reduced = $bank->reduce($sum, "USD");

        $this->assertTrue(Money::dollar(10)->equals($reduced));
    }

    /**
     * @return void
     */
    public function testPlusReturnsSum(): void
    {
        $five = Money::dollar(5);
        $result = $five->plus($five);

        $this->assertTrue($five->equals($result->augend));
        $this->assertTrue($five->equals($result->addend));
    }

    /**
     * @return void
     */
    public function testReduceSum(): void
    {
        $sum = new Sum(Money::dollar(3), Money::dollar(4));
        $bank = new Bank();
        $result = $bank->reduce($sum, "USD");

        $this->assertTrue(Money::dollar(7)->equals($result));
    }

    /**
     * @return void
     */
    public function testReduceMoney(): void
    {
        $bank = new Bank();
        $result = $bank->reduce(Money::dollar(1), "USD");

        $this->assertTrue(Money::dollar(1)->equals($result));
    }
}