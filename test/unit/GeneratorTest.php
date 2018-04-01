<?php

namespace PTS\Tools;

use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase
{
    /**
     * @param int $len
     * @param string $chars
     * @param string $expected
     *
     * @throws \Exception
     *
     * @dataProvider dataProviderForGenerateRandomString
     */
    public function testGenerateRandomString(int $len, string $chars, string $expected = null): void
    {
        $generator = new Generator;
        $actual = $generator->generateRandomString($len, $chars);

        $regexpChars = str_replace(['[', ']'], ['\[', '\]'], $chars);
        $regexp = "~^[{$regexpChars}]{{$len},{$len}}$~";
        preg_match($regexp, $actual, $matches);

        self::assertSame($len, \strlen($actual));
        self::assertSame($matches[0], $actual);

        if ($expected) {
            self::assertSame($expected, $actual);
        }
    }

    public function dataProviderForGenerateRandomString(): array
    {
        return [
            [4, 'a', 'aaaa'],
            [4, 'abc'],
            [10, '#od4inj3$.#<m.?[$#495852]'],
        ];
    }

}