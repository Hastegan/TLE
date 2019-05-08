<?php
declare(strict_types=1);

namespace Hastegan\Tle\Utility;

use DateTime;
use Hastegan\Tle\Exception\TleLineWithNoChecksumLengthException;

/**
 * The checks performed here are made based on:
 *     - CelesTrak's faq on TLEs (https://celestrak.com/columns/v04n03/)
 *     - SpaceTrak's documentation on TLEs (https://www.space-track.org/documentation#tle)
 */
class TleUtilities
{
    public const STRICT = 1;

    public const CLASSIFICATION_UNCLASSIFIED = 'U';

    /**
     * @param string $line
     *
     * @return bool
     */
    public static function firstLineNumberIsValid(string $line): bool
    {
        if (2 > strlen($line)) {
            return false;
        }

        return '1 ' === substr($line, 0, 2);
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

        return 0 !== (int) $satelliteNumber;
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
        $internationalDesignator = rtrim($internationalDesignator);

        if (5 !== strlen($internationalDesignator)) {
            return false;
        }

        if (!ctype_digit($internationalDesignator)) {
            return false;
        }

        return 0 !== (int) substr($internationalDesignator, 2, 3);
    }

    /**
     * @param string $payload
     *
     * @return bool
     */
    public static function payloadIsValid(string $payload): bool
    {
        $payload = rtrim($payload);

        if (3 < strlen($payload)) {
            return false;
        }

        return preg_match('/^[A-Z]{0,3}$/', $payload) === 1;
    }

    /**
     * @param string $epoch
     *
     * @return bool
     */
    public static function elementSetEpochIsValid(string $epoch): bool
    {
        if (14 !== strlen($epoch)) {
            return false;
        }

        if ('.' !== $epoch{5}) {
            return false;
        }

        if (!ctype_digit(substr($epoch, 0, 2))) {
            return false;
        }

        if (!ctype_digit(ltrim(substr($epoch, 2, 3)))) {
            return false;
        }

        if (!ctype_digit(substr($epoch, 6, 8))) {
            return false;
        }

        $twoDigitsYear = (int) substr($epoch, 0, 2);

        $year = 1900;
        if (57 >= $twoDigitsYear) {
            $year = 2000;
        }

        $year = (string) ($year + $twoDigitsYear);

        $isLeapYear = DateTime::createFromFormat('Y', $year)->format('L') === '1';

        $maxDays = 365;
        if ($isLeapYear) {
            $maxDays = 366;
        }

        return $maxDays > (float) substr($epoch, 2, 12);
    }

    /**
     * @param string $meanMotion
     *
     * @return bool
     */
    public static function firstTimeMeanMotionDerivativeIsValid(string $meanMotion): bool
    {
        if (10 !== strlen($meanMotion)) {
            return false;
        }

        if (!in_array($meanMotion{0}, [' ', '-', '+'])) {
            return false;
        }

        if ('.' !== $meanMotion{1}) {
            return false;
        }

        return ctype_digit(substr($meanMotion, 2, 8));
    }

    /**
     * @param string $meanMotion
     *
     * @return bool
     */
    public static function secondTimeMeanMotionDerivativeIsValid(string $meanMotion): bool
    {
        if (strlen($meanMotion) !== 7) {
            return false;
        }

        if ($meanMotion{5} !== '-') {
            return false;
        }

        if (!ctype_digit(substr($meanMotion, 0, 5))) {
            return false;
        }

        if (!ctype_digit(substr($meanMotion, 6, 1))) {
            return false;
        }

        return true;
    }

    /**
     * @param string $drag
     *
     * @return bool
     */
    public static function bStarDragIsValid(string $drag): bool
    {
        if (7 !== strlen($drag)) {
            return false;
        }

        if ('-' !== $drag{5}) {
            return false;
        }

        if (!ctype_digit(substr($drag, 0, 5))) {
            return false;
        }

        return ctype_digit(substr($drag, 6, 1));
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    public static function elementSetTypeIsValid(string $type): bool
    {
        return '0' === $type;
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    public static function elementSetNumberIsValid(string $type): bool
    {
        if (3 !== strlen($type)) {
            return false;
        }

        if (!ctype_digit(ltrim($type))) {
            return false;
        }

        return 0 !== (int) $type;
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
     *
     * @return bool
     */
    public static function secondLineNumberIsValid(string $line): bool
    {
        if (2 > strlen($line)) {
            return false;
        }

        return '2 ' === substr($line, 0, 2);
    }

    /**
     * @param string $inclination
     *
     * @return bool
     */
    public static function orbitInclinationIsValid(string $inclination): bool
    {
        if (strlen($inclination) !== 7) {
            return false;
        }

        if ('.' !== $inclination{2}) {
            return false;
        }

        if (!ctype_digit(ltrim(substr($inclination, 0, 2)))) {
            return false;
        }

        if (!ctype_digit(substr($inclination, 3, 4))) {
            return false;
        }

        return true;
    }

    /**
     * @param string $ascendingNode
     *
     * @return bool
     */
    public static function ascendingNodeIsValid(string $ascendingNode): bool
    {
        return self::checkDegrees($ascendingNode);
    }

    /**
     * @param string $eccentricity
     *
     * @return bool
     */
    public static function eccentricityIsValid(string $eccentricity): bool
    {
        if (7 !== strlen($eccentricity)) {
            return false;
        }

        return ctype_digit($eccentricity);
    }

    /**
     * @param string $argumentOfPerigee
     *
     * @return bool
     */
    public static function argumentOfPerigeeIsValid(string $argumentOfPerigee): bool
    {
        return self::checkDegrees($argumentOfPerigee);
    }

    /**
     * @param string $meanAnomaly
     *
     * @return bool
     */
    public static function meanAnomalyIsValid(string $meanAnomaly): bool
    {
        return self::checkDegrees($meanAnomaly);
    }

    /**
     * @param string $meanMotion
     *
     * @return bool
     */
    public static function meanMotionIsValid(string $meanMotion): bool
    {
        if (11 !== strlen($meanMotion)) {
            return false;
        }

        if ('.' !== $meanMotion{2}) {
            return false;
        }

        if (!ctype_digit(ltrim(substr($meanMotion, 0, 2)))) {
            return false;
        }

        if (!ctype_digit(substr($meanMotion, 3, 8))) {
            return false;
        }

        return true;
    }

    private static function checkDegrees($value): bool
    {
        if (8 !== strlen($value)) {
            return false;
        }

        if ('.' !== $value{3}) {
            return false;
        }

        if (!ctype_digit(ltrim(substr($value, 0, 3)))) {
            return false;
        }

        if (!ctype_digit(substr($value, 4, 4))) {
            return false;
        }

        if (360 < $value) {
            return false;
        }

        return true;
    }

}
