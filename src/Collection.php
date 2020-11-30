<?php
declare(strict_types = 1);

namespace PTS\Tools;

class Collection implements CollectionInterface
{
    protected array $items = [];

    public function addItem(string $name, mixed $item, int $priority = 50): static
    {
        if ($this->has($name)) {
            throw new DuplicateKeyException('Item with name '.$name.' already defined');
        }

        $this->items[$priority][$name] = $item;
        return $this;
    }

    public function removeItem(string $name, int $priority = null): static
    {
        if ($priority === null) {
            return $this->removeItemWithoutPriority($name);
        }

        if ($this->items[$priority][$name] ?? false) {
            unset($this->items[$priority][$name]);
        }

        return $this;
    }

    protected function removeItemWithoutPriority(string $name): static
    {
        foreach ($this->items as $priority => $items) {
            if ($items[$name] ?? false) {
                unset($this->items[$priority][$name]);
            }
        }

        return $this;
    }

    public function has(string $name): bool
    {
        foreach ($this->items as $items) {
            if ($items[$name] ?? false) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param bool $sort
     * @return array[]
     */
    public function getItems(bool $sort = true): array
    {
        $items = $this->items;

        if ($sort) {
            krsort($items, SORT_NUMERIC);
        }

        return $items;
    }

    public function getFlatItems(bool $sort = true): array
    {
        $flatItems = [];

        foreach ($this->getItems($sort) as $items) {
            foreach ($items as $name => $item) {
                $flatItems[$name] = $item;
            }
        }

        return $flatItems;
    }

    /**
     * @return $this
     */
    public function flush(): static
    {
        $this->items = [];
        return $this;
    }
}
