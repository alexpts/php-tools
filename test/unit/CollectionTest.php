<?php
namespace PTS\Tools;

class CollectionTest extends \PHPUnit_Framework_TestCase
{
    /** @var Collection */
    protected $coll;

    protected function setUp()
    {
        $this->coll = new Collection;
    }

    public function testAddItem()
    {
        $this->coll->addItem('jquery', 'jquery.js');
        $items = $this->coll->getItems();

        $expected = [
            50 => [
                'jquery' => 'jquery.js'
            ]
        ];

        self::assertEquals($expected, $items);
    }

    public function testDuplicateItem()
    {
        $this->expectException(DuplicateKeyException::class);
        $this->coll->addItem('jquery', 'jquery.js');
        $this->coll->addItem('jquery', 'some.css');
    }

    public function testAddItemWithPriority()
    {
        $this->coll->addItem('jquery', 'jquery.js', 21);
        $items = $this->coll->getItems();

        $expected = [
            21 => [
                'jquery' => 'jquery.js'
            ]
        ];

        self::assertEquals($expected, $items);
    }

    public function testRemoveItemWithoutPriority()
    {
        $this->coll->addItem('jquery', 'jquery.js');
        $this->coll->removeItem('jquery');
        $items = $this->coll->getItems();

        self::assertCount(0, $items[50]);
    }

    public function testRemoveItemWithPriority()
    {
        $this->coll->addItem('jquery', 'jquery.js');
        $this->coll->removeItem('jquery', 50);
        $items = $this->coll->getItems();

        self::assertCount(0, $items[50]);
    }

    public function testFlush()
    {
        $this->coll->addItem('jquery', 'jquery.js');
        $this->coll->flush();
        $items = $this->coll->getItems();

        self::assertCount(0, $items);
    }

    public function testGetFlatSortedItems()
    {
        $this->coll->addItem('jquery', 'jquery.js', 20);
        $this->coll->addItem('bootstrap', 'bootstrap.js', 60);

        $items = $this->coll->getFlatSortedItems();
        $expected = ['bootstrap.js', 'jquery.js'];

        self::assertEquals($expected, $items);
    }

    public function testGetSortedItem()
    {
        $this->coll->addItem('jquery', 'jquery.js', 20);
        $this->coll->addItem('bootstrap', 'bootstrap.js', 60);

        $items = $this->coll->getSortedItems();
        $expected = [
            60 => [
                'bootstrap' => 'bootstrap.js'
            ],
            20 => [
                'jquery' => 'jquery.js'
            ]
        ];

        self::assertEquals($expected, $items);
    }

}