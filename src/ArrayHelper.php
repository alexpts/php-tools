<?php
declare(strict_types = 1);

namespace PTS\Tools;

class ArrayHelper
{

    /**
     * Разделяет массив на n частей с сохранением порядка и индексов
     * Каждый callback (=true) является бакетом. Все что осталось (все callback = false) становится последним бакетом
     *
     * @param array $collection
     * @param callable ...$callbacks
     *
     * @return array
     */
    public function partition(array $collection, callable ...$callbacks): array
    {
        $partitions = array_fill(0, count($callbacks) + 1, []);

        foreach ($collection as $index => $element) {
            $partition = 0;
            foreach ($callbacks as $partition => $callback) {
                if ($callback($element, $index, $collection)) {
                    $partitions[$partition][$index] = $element;
                    continue 2;
                }
            }
            $partition++;
            $partitions[$partition][$index] = $element;
        }

        return $partitions;
    }
}
