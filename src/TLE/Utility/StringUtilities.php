<?php
declare(strict_types=1);

namespace Platerre\Tle\Utility;

class StringUtilities
{
    /**
     * @param string $haystack
     * @param string $needle
     *
     * @return bool
     */
    public static function startsWith(string $haystack, string $needle): bool
    {
        return substr($haystack, 0, strlen($needle)) === $needle;
    }
}
