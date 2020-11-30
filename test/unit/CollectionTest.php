<?php
declare(strict_types=1);

namespace PTS\Tools;

use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    protected Collection $coll;

    protected function setUp(): void
    {
        parent::setUp();
        $this->coll = new Collection;
    }

    public function testAddItem(): void
    {
        $this->coll->addItem('jquery', 'jquery.js');
        $items = $this->coll->getItems();

        $expected = [
            50 => [
                'jquery' => 'jquery.js'
            ]
        ];

        self::assertSame($expected, $items);
    }

    public function testDuplicateItem(): void
    {
        $this->expectException(DuplicateKeyException::class);
        $this->coll->addItem('jquery', 'jquery.js');
        $this->coll->addItem('jquery', 'some.css');
    }

    public function testAddItemWithPriority(): void
    {
        $this->coll->addItem('jquery', 'jquery.js', 21);
        $items = $this->coll->getItems();

        $expected = [
            21 => [
                'jquery' => 'jquery.js'
            ]
        ];

        self::assertSame($expected, $items);
    }

    public function testRemoveItemWithoutPriority(): void
    {
        $this->coll->addItem('jquery', 'jquery.js');
        $this->coll->removeItem('jquery');
        $items = $this->coll->getItems();

        self::assertCount(0, $items[50]);
    }

    public function testRemoveItemWithPriority(): void
    {
        $this->coll->addItem('jquery', 'jquery.js');
        $this->coll->removeItem('jquery', 50);
        $items = $this->coll->getItems();

        self::assertCount(0, $items[50]);
    }

    public function testFlush(): void
    {
        $this->coll->addItem('jquery', 'jquery.js');
        $this->coll->flush();
        $items = $this->coll->getItems();

        self::assertCount(0, $items);
    }

    public function testGetFlatSortedItems(): void
    {
        $this->coll->addItem('jquery', 'jquery.js', 20);
        $this->coll->addItem('bootstrap', 'bootstrap.js', 60);

        $items = $this->coll->getFlatItems(true);
        $expected = ['bootstrap' => 'bootstrap.js', 'jquery' => 'jquery.js'];

        self::assertSame($expected, $items);
    }

    public function testGetSortedItem(): void
    {
        $this->coll->addItem('jquery', 'jquery.js', 20);
        $this->coll->addItem('bootstrap', 'bootstrap.js', 60);

        $items = $this->coll->getItems(true);
        $expected = [
            60 => [
                'bootstrap' => 'bootstrap.js'
            ],
            20 => [
                'jquery' => 'jquery.js'
            ]
        ];

        self::assertSame($expected, $items);
    }

}