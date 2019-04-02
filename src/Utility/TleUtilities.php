<?php
declare(strict_types=1);

namespace Alk\TLE\Utility;

use Alk\TLE\Exception\TleLineWithNoChecksumLengthException;

/**
 * The checks performed here are made based on:
 *     - CelesTrak's faq on TLEs (https://celestrak.com/columns/v04n03/)
 *     - SpaceTrak's documentation on TLEs (https://www.space-track.org/documentation#tle)
 */
class TleUtilities
{
    public const STRICT = 1;

    public const FIRST_LINE_NUMBER = '1';
    public const SECOND_LINE_NUMBER = '2';

    public const CLASSIFICATION_UNCLASSIFIED = 'U';

    /**
     * @param string $line
     * @param int    $flag
     *
     * @return bool
     */
    public static function firstLineNumberIsValid(string $line, int $flag = 0): bool
    {
        if (self::STRICT === $flag) {
            if (2 > strlen($line)) {
                return false;
            }

            return StringUtilities::startsWith($line, self::FIRST_LINE_NUMBER . ' ');
        }

        if (0 === strlen($line)) {
            return false;
        }

        return StringUtilities::startsWith($line, self::FIRST_LINE_NUMBER);
    }

    /**
     * @param string $satelliteNumber
     *
     * @return bool
     */
    public static function satelliteNumberIsValid(string $satelliteNumber): bool
    {
        if (5 < strlen($satelliteNumber)) {
            return false;
        }

        if (0 === (int) $satelliteNumber) {
            return false;
        }

        return true;
    }

    /**
     * @param string $classification
     *
     * @return bool
     */
    public static function classificationIsValid(string $classification): bool
    {
        if (empty($classification)) {
            return true;
        }

        return preg_match('/^[A-Z]$/', $classification) === 1;
    }

    /**
     * @param string $internationalDesignator
     *
     * @return bool
     */
    public static function internationalDesignatorIsValid(string $internationalDesignator): bool
    {
        // Todo
        return false;
    }

    /**
     * @param string $payload
     *
     * @return bool
     */
    public static function payloadIsValid(string $payload): bool
    {
        // Todo
        return false;
    }

    /**
     * @param string $epoch
     *
     * @return bool
     */
    public static function elementSetEpochIsValid(string $epoch): bool
    {
        // Todo
        return false;
    }

    /**
     * @param string $meanMotion
     *
     * @return bool
     */
    public static function firstTimeMeanMotionDerivativeIsValid(string $meanMotion): bool
    {
        // Todo
        return false;
    }

    /**
     * @param string $meanMotion
     *
     * @return bool
     */
    public static function secondTimeMeanMotionDerivativeIsValid(string $meanMotion): bool
    {
        // Todo
        return false;
    }

    /**
     * @param string $drag
     *
     * @return bool
     */
    public static function bStarDragIsValid(string $drag): bool
    {
        // Todo
        return false;
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    public static function elementSetTypeIsValid(string $type): bool
    {
        // Todo
        return false;
    }

    /**
     * Calculates the checksum for Two Line Element line
     *
     * The expected value is a 68 character long string, corresponding to a
     * two line element without its checksum
     *
     * @param string $line   Two Line Element line with no checksum
     * @param int    $flag
     *
     * @return int
     */
    public static function calculateChecksum(string $line, int $flag = 0)
    {
        if ($flag === self::STRICT && 68 !== strlen($line)) {
            throw new TleLineWithNoChecksumLengthException();
        }

        $lineValue = 0;
        foreach (str_split($line) as $character) {
            if (is_numeric($character)) {
                $lineValue += (int) $character;

                continue;
            }

            if ($character === '-') {
                $lineValue += 1;
            }
        }

        return $lineValue % 10;
    }

    /**
     * @param string $line
     * @param int    $flag
     *
     * @return bool
     */
    public static function secondLineNumberIsValid(string $line, int $flag = 0): bool
    {
        if (self::STRICT === $flag) {
            if (2 > strlen($line)) {
                return false;
            }

            return StringUtilities::startsWith($line, self::SECOND_LINE_NUMBER . ' ');
        }

        if (0 === strlen($line)) {
            return false;
        }

        return StringUtilities::startsWith($line, self::SECOND_LINE_NUMBER);
    }

    /**
     * @param string $inclination
     *
     * @return bool
     */
    public static function orbitInclinationIsValid(string $inclination): bool
    {
        // Todo
        return false;
    }

    /**
     * @param string $ascendingNode
     *
     * @return bool
     */
    public static function ascendingNodeIsValid(string $ascendingNode): bool
    {
        // Todo
        return false;
    }

    /**
     * @param string $eccentricity
     *
     * @return bool
     */
    public static function eccentricityIsValid(string $eccentricity): bool
    {
        if (empty($eccentricity)) {
            return false;
        }

        return is_numeric($eccentricity);
    }

    /**
     * @param string $argumentOfPerigee
     *
     * @return bool
     */
    public static function argumentOfPerigeeIsValid(string $argumentOfPerigee): bool
    {
        // Todo
        return false;
    }

    /**
     * @param string $meanAnomaly
     *
     * @return bool
     */
    public static function meanAnomalyIsValid(string $meanAnomaly): bool
    {
        // Todo
        return false;
    }

    /**
     * @param string $meanMotion
     *
     * @return bool
     */
    public static function meanMotionIsValid(string $meanMotion): bool
    {
        // Todo
        return false;
    }
}
