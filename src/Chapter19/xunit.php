<?php

declare(strict_types=1);

namespace Chapter19;

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
    protected function setUp(): void
    {
        //
    }

    /**
     * @return void
     */
    public function run(): void
    {
        $this->setUp();
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
     * @var bool $wasSetUp
     */
    private bool $wasSetUp;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->wasRun = false;
        $this->wasSetUp = true;
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

    /**
     * @return bool
     */
    public function wasSetUp(): bool
    {
        return $this->wasSetUp;
    }
}

class TestCaseTest extends TestCase
{
    /**
     * @var WasRun $test
     */
    private WasRun $test;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->test = new WasRun('testMethod');
    }

    /**
     * @return void
     */
    public function testRunning(): void
    {
        $this->test->run();
        assert($this->test->wasRun());
    }

    /**
     * @return void
     */
    public function testSetUp(): void
    {
        $this->test->run();
        assert($this->test->wasSetUp());
    }
}

ini_set('assert.active', '1');
ini_set('assert.exception', '1');

(new TestCaseTest("testRunning"))->run();
(new TestCaseTest("testSetUp"))->run();