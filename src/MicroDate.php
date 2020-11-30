<?php
declare(strict_types=1);

namespace PTS\Tools;

use DateTime;
use DateTimeZone;

class MicroDate
{
    public int $sec;
    public int $uSec;

    /**
     * @param int $sec
     * @param int $uSec
     */
    public function __construct(int $sec, int $uSec)
    {
        $this->sec = $sec;
        $this->uSec = $uSec;
    }

    /**
     * @param DateTime $date
     *
     * @return MicroDate
     */
    public static function createFromDateTime(DateTime $date): MicroDate
    {
        return new self($date->getTimestamp(), (int)$date->format('u'));
    }

    /**
     * @return MicroDate
     */
    public static function now(): MicroDate
    {
        [$uSec, $sec] = explode(' ', microtime());
        $uSec = (float)$uSec * 100000;
        return new self((int)$sec, (int)$uSec);
    }

    /**
     * @param DateTimeZone|null $timeZone
     *
     * @return DateTime
     */
    public function toDateTime(DateTimeZone $timeZone = null): DateTime
    {
        $date = DateTime::createFromFormat('U.u', $this->sec . '.' . $this->uSec);
        if ($timeZone) {
            $date->setTimezone($timeZone);
        }

        return $date;
    }
}
