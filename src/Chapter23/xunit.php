<?php

declare(strict_types=1);

namespace Chapter23;

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
     * @param TestResult $result
     * @return void
     */
    public function run(TestResult $result): void
    {
        $result->testStarted();

        $this->setUp();

        try {
            call_user_func([$this, $this->name]);
        } catch (Exception $e) {
            $result->testFailed();
        }

        $this->tearDown();
    }
}

class TestResult
{
    /**
     * @var int
     */
    private int $runCount = 0;

    /**
     * @var int
     */
    private int $errorCount = 0;

    /**
     * @return void
     */
    public function testStarted(): void
    {
        $this->runCount++;
    }

    /**
     * @return void
     */
    public function testFailed(): void
    {
        $this->errorCount++;
    }

    /**
     * @return string
     */
    public function summary(): string
    {
        return sprintf('%d run, %d failed', $this->runCount, $this->errorCount);
    }
}

class TestSuite
{
    /**
     * @var array|TestCase[]
     */
    private $tests = [];

    /**
     * @param TestCase $testCase
     * @return void
     */
    public function add(TestCase $testCase): void
    {
        $this->tests[] = $testCase;
    }

    /**
     * @param TestResult $result
     * @return void
     */
    public function run(TestResult $result): void
    {
        foreach ($this->tests as $test) {
            $test->run($result);
        }
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
        throw new \Exception();
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
     * @var TestResult
     */
    private TestResult $result;

    protected function setUp(): void
    {
        parent::setUp();

        $this->result = new TestResult();
    }

    /**
     * @return void
     */
    public function testTemplateMethod(): void
    {
        $test = new WasRun("testMethod");
        $test->run($this->result);
        assert('setUp testMethod tearDown ' === $test->log());
    }

    /**
     * @return void
     */
    public function testResult(): void
    {
        $test = new WasRun("testMethod");
        $test->run($this->result);
        assert("1 run, 0 failed" === $this->result->summary());
    }

    /**
     * @return void
     */
    public function testFailedResult(): void
    {
        $test = new WasRun("testBrokenMethod");
        $test->run($this->result);
        assert("1 run, 1 failed" === $this->result->summary());
    }

    /**
     * @return void
     */
    public function testFailedResultFormatting(): void
    {
        $result = new TestResult();
        $this->result->testStarted();
        $this->result->testFailed();
        assert("1 run, 1 failed" === $this->result->summary());
    }

    /**
     * @return void
     */
    public function testSuite(): void
    {
        $suite = new TestSuite();
        $suite->add(new WasRun("testMethod"));
        $suite->add(new WasRun("testBrokenMethod"));

        $suite->run($this->result);
        assert("2 run, 1 failed" === $this->result->summary());
    }
}

ini_set('assert.active', '1');
ini_set('assert.exception', '1');

$suite = new TestSuite();
$suite->add(new TestCaseTest("testTemplateMethod"));
$suite->add(new TestCaseTest("testResult"));
$suite->add(new TestCaseTest("testFailedResult"));
$suite->add(new TestCaseTest("testFailedResultFormatting"));
$suite->add(new TestCaseTest("testSuite"));

$result = new TestResult();
$suite->run($result);
echo $result->summary(), PHP_EOL;
assert("5 run, 0 failed" === $result->summary());
