<?php

namespace PTS\Tools;

class ArrayHelper
{

    public function partition(array $collection, callable ...$callbacks): array
    {
        $partitions = array_fill(0, count($callbacks) + 1, []);

        foreach ($collection as $index => $element) {
            foreach ($callbacks as $partition => $callback) {
                if ($callback($element, $index, $collection)) {
                    $partitions[$partition][] = $element;
                    continue 2;
                }
            }
            $partition++;
            $partitions[$partition][] = $element;
        }

        return $partitions;
    }
}
