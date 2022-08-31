<?php

declare(strict_types=1);

namespace Chapter21;

use Exception;

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
     * @return TestResult
     */
    public function run(): TestResult
    {
        $result = new TestResult();
        $result->testStarted();

        $this->setUp();
        call_user_func([$this, $this->name]);
        $this->tearDown();

        return $result;
    }
}

class TestResult
{
    /**
     * @var int
     */
    private int $runCount;

    public function __construct()
    {
        $this->runCount = 1;
    }

    /**
     * @return void
     */
    public function testStarted(): void
    {
        $this->runCount = $this->runCount++;
    }

    /**
     * @return string
     */
    public function summary(): string
    {
        return sprintf('%d run, 0 failed', $this->runCount);
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
     * @throws Exception
     */
    public function testBrokenMethod(): void
    {
        throw new Exception();
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

    /**
     * @return void
     */
    public function testResult(): void
    {
        $test = new WasRun("testMethod");
        $result = $test->run();
        assert("1 run, 0 failed" === $result->summary());
    }

    /**
     * @return void
     */
    public function testFailedResult(): void
    {
        $test = new WasRun("testBrokenMethod");
        $result = $test->run();
        assert("1 run, 1 failed" === $result->summary());
    }
}

ini_set('assert.active', '1');
ini_set('assert.exception', '1');

(new TestCaseTest("testTemplateMethod"))->run();
(new TestCaseTest("testResult"))->run();
// (new TestCaseTest("testFailedResult"))->run();