<?php

namespace PTS\Tools;

use PHPUnit\Framework\TestCase;

class RegExpFactoryTest extends TestCase
{
    /** @var RegExpFactory */
    protected $factory;

    protected function setUp(): void
    {
        $this->factory = new RegExpFactory;
    }

    public function testCreateRegExp(): void
    {
        $regExp = $this->factory->create('~[^\d\+]~');
        static::assertEquals('71232131231', $regExp('+7(123) 213-1231'));
    }
}
