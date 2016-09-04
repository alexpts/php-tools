<?php
declare(strict_types = 1);
namespace PTS\Tools;

interface CollectionInterface
{
    public function addItem(string $name, $item, int $priority = 50);

    public function removeItem(string $name, int $priority = null);

    public function has(string $name) : bool;

    public function getItems() : array;

    public function flush();
}
