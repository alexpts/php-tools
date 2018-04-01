<?php
declare(strict_types=1);

namespace PTS\Tools;

class Generator
{
    /**
     * @param int $length
     * @param string $chars
     *
     * @return string
     * @throws \Exception
     */
    public function generateRandomString(
        int $length = 10,
        string $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!#%^*()-_[]{}<>=/|$'
    ): string {
        $randomStr = '';
        for ($i = 0; $i < $length; $i++) {
            $randomCharIndex = random_int(0, \strlen($chars) - 1);
            $randomStr .= $chars[$randomCharIndex];
        }

        return $randomStr;
    }
}
