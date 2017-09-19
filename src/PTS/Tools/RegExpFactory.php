<?php
declare(strict_types=1);

namespace PTS\Tools;

class RegExpFactory
{
    public function create(string $pattern, string $replacement = ''): callable
    {
        return function ($value) use ($pattern, $replacement): string {
            return preg_replace($pattern, $replacement, $value);
        };
    }
}
