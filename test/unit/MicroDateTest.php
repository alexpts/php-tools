<?php
declare(strict_types=1);

namespace PTS\Tools;

use DateTime;
use DateTimeZone;
use PHPUnit\Framework\TestCase;

class MicroDateTest extends TestCase
{
    public function testCreate(): void
    {
        $microDate = new MicroDate(12, 10);
        self::assertSame(12, $microDate->sec);
        self::assertSame(10, $microDate->uSec);
    }

    public function testCreateFromDateTime(): void
    {
        $date = new DateTime('2018-04-01T18:33:57.346Z');
        $microDate = MicroDate::createFromDateTime($date);

        self::assertSame($date->getTimestamp(), $microDate->sec);
        self::assertSame(346000, $microDate->uSec);
    }

    public function testNow(): void
    {
        $date = new DateTime;
        $microDate = MicroDate::now();

        self::assertSame($date->getTimestamp(), $microDate->sec);
        self::assertTrue($microDate->uSec > 0);
    }

    public function testToDateTime(): void
    {
        $microDate = MicroDate::now();
        $actual = $microDate->toDateTime();

        self::assertInstanceOf(DateTime::class, $actual);
        self::assertSame($microDate->sec, $actual->getTimestamp());
        self::assertSame('+00:00', $actual->getTimezone()->getName());
    }

    public function testToDateTimeTimeZone(): void
    {
        $microDate = MicroDate::now();
        $timeZone = new DateTimeZone('+0200');
        $actual = $microDate->toDateTime($timeZone);

        self::assertInstanceOf(DateTime::class, $actual);
        self::assertSame($microDate->sec, $actual->getTimestamp());
        self::assertSame('+02:00', $actual->getTimezone()->getName());
    }

}