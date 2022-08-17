<?php

declare(strict_types=1);

namespace Chapter18;

class TestCase
{
    /**
     * @var string
     */
    protected string $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return void
     */
    public function run(): void
    {
        call_user_func([$this, $this->name]);
    }
}

class WasRun extends TestCase
{
    /**
     * @var bool
     */
    private bool $wasRun;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->wasRun = false;
    }

    /**
     * @return void
     */
    public function testMethod(): void
    {
        $this->wasRun = true;
    }

    /**
     * @return bool
     */
    public function wasRun(): bool
    {
        return $this->wasRun;
    }
}

class TestCaseTest extends TestCase
{
    /**
     * @return void
     */
    public function testRunning(): void
    {
        $test = new WasRun('testMethod');
        assert(!$test->wasRun());
        $test->run();
        assert($test->wasRun());
    }
}

ini_set('assert.active', '1');
ini_set('assert.exception', '1');

(new TestCaseTest("testRunning"))->run();