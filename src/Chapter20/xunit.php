<?php

declare(strict_types=1);

namespace Chapter20;

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
    protected function tearDown(): void
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
        $this->tearDown();
    }
}

class WasRun extends TestCase
{
    /**
     * @var string $log
     */
    private string $log;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->log = "setUp ";
    }

    /**
     * @return void
     */
    public function testMethod(): void
    {
        $this->log .= "testMethod ";
    }

    /**
     * @return void
     */
    protected function tearDown(): void
    {
        $this->log .= "tearDown ";
    }

    /**
     * @return string
     */
    public function log(): string
    {
        return $this->log;
    }
}

class TestCaseTest extends TestCase
{
    /**
     * @return void
     */
    public function testTemplateMethod(): void
    {
        $test = new WasRun("testMethod");
        $test->run();
        assert('setUp testMethod tearDown ' === $test->log());
    }
}

ini_set('assert.active', '1');
ini_set('assert.exception', '1');

(new TestCaseTest("testTemplateMethod"))->run();