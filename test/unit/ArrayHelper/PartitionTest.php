<?php
declare(strict_types=1);

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

        static::assertSame(['1', 'false', true, 34], array_values($trueCollection));
        static::assertSame([0, '0', false, null], array_values($falseCollection));
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

        static::assertSame(['1', '0', 'false'], array_values($strings));
        static::assertSame([true, false], array_values($bool));
        static::assertSame([0, null, 34], array_values($other));
    }

    public function testSaveIndex(): void
    {
        $data = ['n1' => 0, 'n2' => 100, 'n3' => 50];
        $helper = new ArrayHelper;
        [$less100, $other] = $helper->partition($data, function ($element, $index, array $collection): bool {
            return $element < 100;
        });

        static::assertSame(['n1' => 0, 'n3' => 50], $less100);
        static::assertSame(['n2' => 100], $other);
    }
}