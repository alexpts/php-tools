<?php
declare(strict_types = 1);

namespace PTS\Tools;

interface CollectionInterface
{

    public function addItem(string $name, mixed $item, int $priority = 50): static;

    public function removeItem(string $name, int $priority = null): static;

    public function has(string $name) : bool;

    public function getItems(bool $sort = true) : array;

    public function getFlatItems(bool $sort = true) : array;

    public function flush(): static;
}
