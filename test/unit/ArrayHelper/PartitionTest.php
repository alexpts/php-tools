<?php

use PHPUnit\Framework\TestCase;
use PTS\Tools\ArrayHelper;

class PartitionTest extends TestCase
{

    public function testSplitByCallback(): void
    {
        $data = ['1', 0, '0', 'false', true, false, null, 34];
        $helper = new ArrayHelper;
        [$trueCollection, $falseCollection] = $helper->partition($data, function ($element, $index, array $collection) {
           return (bool)$element === true;
        });

        static::assertSame(['1', 'false', true, 34], $trueCollection);
        static::assertSame([0, '0', false, null], $falseCollection);
    }

    public function testSplitByCallbacks(): void
    {
        $data = ['1', 0, '0', 'false', true, false, null, 34];
        $helper = new ArrayHelper;
        [$strings, $bool, $other] = $helper->partition($data,
            function ($element, $index, array $collection) {
                return is_string($element);
            },
            function ($element, $index, array $collection) {
                return is_bool($element);
            }
        );

        static::assertSame(['1', '0', 'false'], $strings);
        static::assertSame([true, false], $bool);
        static::assertSame([0, null, 34], $other);
    }
}