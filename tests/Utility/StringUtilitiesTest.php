<?php
declare(strict_types=1);

namespace Platerre\Tle\Tests\Utility;

use Platerre\Tle\Utility\StringUtilities;
use PHPUnit\Framework\TestCase;

class StringUtilitiesTest extends TestCase
{
    /**
     * @dataProvider startsWithIsTrueProvider
     *
     * @param string $haystack
     * @param string $needle
     */
    public function testStartsWithIsTrue(string $haystack, string $needle): void
    {
        $this->assertTrue(StringUtilities::startsWith($haystack, $needle));
    }

    /**
     * @return array
     */
    public function startsWithIsTrueProvider(): array
    {
        return [
            ['a', 'a'],
            ['aa', 'a'],
            ['abcdefg', 'abc'],
        ];
    }

    /**
     * @dataProvider startsWithIsFalseProvider
     *
     * @param string $haystack
     * @param string $needle
     */
    public function testStartsWithIsFalse(string $haystack, string $needle): void
    {
        $this->assertFalse(StringUtilities::startsWith($haystack, $needle));
    }

    /**
     * @return array
     */
    public function startsWithIsFalseProvider(): array
    {
        return [
            ['b', 'a'],
            ['a', 'aa'],
            ['aab', 'ab'],
        ];
    }
}
