<?php
declare(strict_types=1);

namespace Hastegan\Tle\Utility;

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

    /**
     * @param string $string
     * @param array  $mapping
     *
     * @return bool
     */
    public static function checkChars(string $string, array $mapping): bool
    {
        foreach ($mapping as $index => $char) {
            if ($string{$index} !== $char) {
                return false;
            }
        }

        return true;
    }
}
