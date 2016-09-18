<?php
declare(strict_types = 1);
namespace PTS\Tools;

interface CollectionInterface
{
    /**
     * @param string $name
     * @param mixed $item
     * @param int $priority
     * @return $this
     */
    public function addItem(string $name, $item, int $priority = 50);

    /**
     * @param string $name
     * @param int $priority
     * @return $this
     */
    public function removeItem(string $name, int $priority = null);

    public function has(string $name) : bool;

    public function getItems() : array;

    /**
     * @return $this
     */
    public function flush();
}
