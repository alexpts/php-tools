<?php

namespace PTS\Tools;

use PHPUnit\Framework\TestCase;

class DeepArrayTest extends TestCase
{
    /** @var DeepArray */
    protected $service;

    /** @var array */
    protected $dataSample = [
        'user' => [
            'age' => 12,
            'name' => 'Alex',
            'friends' => ['Bob', 'Rain']
        ]
    ];

    protected function setUp(): void
    {
        $this->service = new DeepArray;
    }

    /**
     * @param array $data
     * @param array $keys
     * @param mixed $expected
     *
     * @dataProvider getDataProvider
     */
    public function testGet(array $data, array $keys, $expected): void
    {
        $value = $this->service->getAttr($keys, $data);
        self::assertEquals($expected, $value);
    }

    public function getDataProvider(): array
    {
        return [
            [$this->dataSample, ['user'], $this->dataSample['user']],
            [$this->dataSample, ['user', 'age'], $this->dataSample['user']['age']],
            [$this->dataSample, ['user', 'unknown'], null],
            [$this->dataSample, ['user', 'friends'], $this->dataSample['user']['friends']],
            [$this->dataSample, ['user', 'friends', 0], $this->dataSample['user']['friends'][0]],
            [$this->dataSample, ['user', 'friends', 1], $this->dataSample['user']['friends'][1]],
        ];
    }

    /**
     * @param array $data
     * @param array $keys
     * @param mixed $value
     * @param array $expected
     *
     * @dataProvider setDataProvider
     */
    public function testSet(array $data, array $keys, $value, array $expected)
    {
        $this->service->setAttr($keys, $data, $value);
        self::assertEquals($expected, $data);
    }

    public function setDataProvider()
    {
        return [
            [[], ['user'], $this->dataSample['user'], ['user' => $this->dataSample['user']]],
            [['age' => 12], ['user'], $this->dataSample['user'], ['age' => 12, 'user' => $this->dataSample['user']]],
            [[], ['user', 'country'], 'En', ['user' => ['country' => 'En']]],
            [['user' => 'Alex'], ['user', 'country'], 'En', ['user' => ['country' => 'En']]],
        ];
    }

    public function testSetWithTrim()
    {
        $data = (clone $this)->dataSample;
        $this->service->setTrim(true);
        $this->service->setAttr(['user', 'age'], $data, null);
        self::assertEquals([
            'user' => [
                'name' => 'Alex',
                'friends' => ['Bob', 'Rain']
            ]
        ], $data);
    }

    public function testGetTrim()
    {
        self::assertFalse($this->service->getTrim());
        self::assertTrue($this->service->setTrim(true)->getTrim());
        self::assertFalse($this->service->setTrim(false)->getTrim());
    }
}