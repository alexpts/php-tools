<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PTS\Tools\TraceFormatter;

class TraceFormatterTest extends TestCase
{
    protected TraceFormatterTest $formatter;

    public function testFormatter(): void
    {
        $relDir = dirname(__DIR__, 2);
        $formatter = new TraceFormatter($relDir);

        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $actual = $formatter->formatTrace($trace);

        $expected = [
            './vendor/phpunit/phpunit/src/Framework/TestCase.php:1536 :: TraceFormatterTest->testFormatter',
            './vendor/phpunit/phpunit/src/Framework/TestCase.php:1142 :: PHPUnit\Framework\TestCase->runTest',
            './vendor/phpunit/phpunit/src/Framework/TestResult.php:730 :: PHPUnit\Framework\TestCase->runBare',
            './vendor/phpunit/phpunit/src/Framework/TestCase.php:883 :: PHPUnit\Framework\TestResult->run',
            './vendor/phpunit/phpunit/src/Framework/TestSuite.php:669 :: PHPUnit\Framework\TestCase->run',
            './vendor/phpunit/phpunit/src/Framework/TestSuite.php:669 :: PHPUnit\Framework\TestSuite->run',
            './vendor/phpunit/phpunit/src/Framework/TestSuite.php:669 :: PHPUnit\Framework\TestSuite->run',
            './vendor/phpunit/phpunit/src/TextUI/TestRunner.php:667 :: PHPUnit\Framework\TestSuite->run',
            './vendor/phpunit/phpunit/src/TextUI/Command.php:148 :: PHPUnit\TextUI\TestRunner->run',
            './vendor/phpunit/phpunit/src/TextUI/Command.php:101 :: PHPUnit\TextUI\Command->run',
            './vendor/phpunit/phpunit/phpunit:61 :: PHPUnit\TextUI\Command::main',
        ];

        static::assertSame($expected, $actual);
    }

}
