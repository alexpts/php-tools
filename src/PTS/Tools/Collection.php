<?php
declare(strict_types = 1);
namespace PTS\Tools;

class Collection implements CollectionInterface
{
    /** @var array */
    protected $items = [];

    /**
     * @param string $name
     * @param mixed $item
     * @param int $priority
     *
     * @return $this
     *
     * @throws DuplicateKeyException
     */
    public function addItem(string $name, $item, int $priority = 50)
    {
        if ($this->has($name)) {
            throw new DuplicateKeyException('Item with name '.$name.' already defined');
        }

        $this->items[$priority][$name] = $item;
        return $this;
    }

    /**
     * @param string $name
     * @param null|int $priority
     *
     * @return $this
     */
    public function removeItem(string $name, int $priority = null)
    {
        if ($priority !== null) {
            if (isset($this->items[$priority][$name])) {
                unset($this->items[$priority][$name]);
            }

            return $this;
        }

        foreach ($this->items as $itemPriority => $items) {
            if (isset($items[$name])) {
                unset($this->items[$itemPriority][$name]);
            }
        }

        return $this;
    }

    public function has(string $name) : bool
    {
        foreach ($this->items as $items) {
            if (isset($items[$name])) {
                return true;
            }
        }

        return false;
    }

    public function getItems() : array
    {
        return $this->items;
    }

    public function getSortedItems() : array
    {
        $items = $this->getItems();
        krsort($items, SORT_NUMERIC);

        return $items;
    }

    public function getFlatSortedItems() : array
    {
        $sortedItems = $this->getSortedItems();
        $flatItems = [];

        /** @var array $items */
        foreach ($sortedItems as $items) {
            foreach ($items as $item) {
                $flatItems[] = $item;
            }
        }

        return $flatItems;
    }

    /**
     * @return $this
     */
    public function flush()
    {
        $this->items = [];
        return $this;
    }
}
