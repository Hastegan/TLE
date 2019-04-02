<?php
declare(strict_types=1);

namespace Hastegan\Tle\Tests\Utility;

use Hastegan\Tle\Exception\TleLineWithNoChecksumLengthException;
use Hastegan\Tle\Utility\TleUtilities;
use PHPUnit\Framework\TestCase;

class TleUtilitiesTest extends TestCase
{
    /**
     * @dataProvider firstLineNumberIsValidProvider
     *
     * @param string $line
     * @param bool   $expected
     */
    public function testFirstLineNumberIsValid(string $line, bool $expected): void
    {
        $this->assertEquals($expected, TleUtilities::firstLineNumberIsValid($line));
    }

    /**
     * @return array
     */
    public function firstLineNumberIsValidProvider(): array
    {
        return [
            ['1', true],
            ['1 ', true],
            ['1foo', true],
            ['2', false],
            ['2 ', false],
            ['foo', false],
        ];
    }

    /**
     * @dataProvider firstLineNumberIsValidStrictProvider
     *
     * @param string $line
     * @param bool   $expected
     */
    public function testFirstLineNumberIsValidStrict(string $line, bool $expected): void
    {
        $this->assertEquals($expected, TleUtilities::firstLineNumberIsValid($line, TleUtilities::STRICT));
    }

    /**
     * @return array
     */
    public function firstLineNumberIsValidStrictProvider(): array
    {
        return [
            ['1 ', true],
            ['1 foo', true],
            ['', false],
            ['1', false],
            ['foo', false],
        ];
    }

    /**
     * @dataProvider satelliteNumberIsValidProvider
     *
     * @param string $satelliteNumber
     * @param bool   $expected
     */
    public function testSatelliteNumberIsValid(string $satelliteNumber, bool $expected): void
    {
        $this->assertEquals($expected, TleUtilities::satelliteNumberIsValid($satelliteNumber));
    }

    /**
     * @return array
     */
    public function satelliteNumberIsValidProvider(): array
    {
        return  [
            ['1', true],
            ['00001', true],
            ['25544', true],
            ['0', false],
            ['00000', false],
            ['999999', false],
            ['a', false],
        ];
    }

    /**
     * @dataProvider classificationIsValidProvider
     *
     * @param string $classification
     * @param bool   $expected
     */
    public function testClassificationIsValidIsTrue(string $classification, bool $expected): void
    {
        $this->assertEquals($expected, TleUtilities::classificationIsValid($classification));
    }

    /**
     * @return array
     */
    public function classificationIsValidProvider(): array
    {
        return [
            ['U', true],
            ['', true],
            ['A', true],
            ['1', false],
            ['UU', false],
            ['u', false],
        ];
    }


    /**
     * @dataProvider internationalDesignatorIsValidProvider
     *
     * @param string $internationalDesignator
     * @param bool   $expected
     */
    public function testInternationalDesignatorIsValid(string $internationalDesignator, bool $expected): void
    {
        $this->assertEquals($expected, TleUtilities::internationalDesignatorIsValid($internationalDesignator));
    }

    /**
     * @return array
     */
    public function internationalDesignatorIsValidProvider(): array
    {
        // Todo
        return [
            ['foo', true],
        ];
    }

    /**
     * @dataProvider payloadIsValidProvider
     *
     * @param string $payload
     * @param bool   $expected
     */
    public function testPayloadIsValid(string $payload, bool $expected): void
    {
        $this->assertEquals($expected, TleUtilities::payloadIsValid($payload));
    }

    /**
     * @return array
     */
    public function payloadIsValidProvider(): array
    {
        // Todo
        return [
            ['foo', true],
        ];
    }

    /**
     * @dataProvider elementSetEpochIsValidProvider
     *
     * @param string $elementSetEpoch
     * @param bool   $expected
     */
    public function testElementSetEpochIsValid(string $elementSetEpoch, bool $expected): void
    {
        $this->assertEquals($expected, TleUtilities::elementSetEpochIsValid($elementSetEpoch));
    }

    /**
     * @return array
     */
    public function elementSetEpochIsValidProvider(): array
    {
        // Todo
        return [
            ['foo', true],
        ];
    }

    /**
     * @dataProvider firstTimeMeanMotionDerivativeIsValidProvider
     *
     * @param string $firstTimeMeanMotionDerivative
     * @param bool   $expected
     */
    public function testFirstTimeMeanMotionDerivativeIsValid(string $firstTimeMeanMotionDerivative, bool $expected): void
    {
        $this->assertEquals($expected, TleUtilities::firstTimeMeanMotionDerivativeIsValid($firstTimeMeanMotionDerivative));
    }

    /**
     * @return array
     */
    public function firstTimeMeanMotionDerivativeIsValidProvider(): array
    {
        // Todo
        return [
            ['foo', true],
        ];
    }

    /**
     * @dataProvider secondTimeMeanMotionDerivativeIsValidProvider
     *
     * @param string $secondTimeMeanMotionDerivative
     * @param bool   $expected
     */
    public function testSecondTimeMeanMotionDerivativeIsValid(string $secondTimeMeanMotionDerivative, bool $expected): void
    {
        $this->assertEquals($expected, TleUtilities::secondTimeMeanMotionDerivativeIsValid($secondTimeMeanMotionDerivative));
    }

    /**
     * @return array
     */
    public function secondTimeMeanMotionDerivativeIsValidProvider(): array
    {
        // Todo
        return [
            ['foo', true],
        ];
    }

    /**
     * @dataProvider bStarDragIsValidProvider
     *
     * @param string $bStarDrag
     * @param bool   $expected
     */
    public function testBStarDragIsValid(string $bStarDrag, bool $expected): void
    {
        $this->assertEquals($expected, TleUtilities::bStarDragIsValid($bStarDrag));
    }

    /**
     * @return array
     */
    public function bStarDragIsValidProvider(): array
    {
        // Todo
        return [
            ['foo', true],
        ];
    }

    /**
     * @dataProvider elementSetTypeIsValidProvider
     *
     * @param string $elementSetType
     * @param bool   $expected
     */
    public function testElementSetTypeIsValid(string $elementSetType, bool $expected): void
    {
        $this->assertEquals($expected, TleUtilities::elementSetTypeIsValid($elementSetType));
    }

    /**
     * @return array
     */
    public function elementSetTypeIsValidProvider(): array
    {
        // Todo
        return [
            ['foo', true],
        ];
    }

    /**
     * @dataProvider calculateChecksumProducer
     *
     * @param string $line
     * @param int    $expectedChecksum
     */
    public function testCalculateChecksum(string $line, int $expectedChecksum): void
    {
        $this->assertEquals($expectedChecksum, TleUtilities::calculateChecksum($line));
    }

    public function calculateChecksumProducer(): array
    {
        return [
            ['', 0],
            ['00000000000000000000000000000000000000000000000000000000000000000000', 0],
            ['000000000000000000000000000000000000000000000000000000000000000000000000000000', 0],
            ['11111111111111111111111111111111111111111111111111111111111111111111', 8],
            ['--------------------------------------------------------------------', 8],
            ['....................................................................', 0],
            ['                                                                    ', 0],
            ['1 44064U 19011B   19081.02720647  .00007720  00000-0  11330-3 0  999', 4],
            ['2 44064  51.6401  74.1606 0005122 132.8422 227.2640 15.56570047  211', 0],
        ];
    }

    public function testCalculateChecksumRisesException(): void
    {
        $this->expectException(TleLineWithNoChecksumLengthException::class);

        TleUtilities::calculateChecksum('0', TleUtilities::STRICT);
    }

    /**
     * @dataProvider secondLineNumberIsValidProvider
     *
     * @param string $line
     * @param bool   $expected
     */
    public function testSecondLineNumberIsValid(string $line, bool $expected): void
    {
        $this->assertEquals($expected, TleUtilities::secondLineNumberIsValid($line));
    }

    /**
     * @return array
     */
    public function secondLineNumberIsValidProvider(): array
    {
        return [
            ['2', true],
            ['2 ', true],
            ['2foo', true],
            ['1', false],
            ['1 ', false],
            ['foo', false],
        ];
    }

    /**
     * @dataProvider secondLineNumberIsValidStrictProvider
     *
     * @param string $line
     * @param bool   $expected
     */
    public function testSecondLineNumberIsValidStrict(string $line, bool $expected): void
    {
        $this->assertEquals($expected, TleUtilities::secondLineNumberIsValid($line, TleUtilities::STRICT));
    }

    /**
     * @return array
     */
    public function secondLineNumberIsValidStrictProvider(): array
    {
        return [
            ['2 ', true],
            ['2 foo', true],
            ['', false],
            ['2', false],
            ['foo', false],
        ];
    }

    /**
     * @dataProvider orbitInclinationIsValidProducer
     *
     * @param string $orbitInclination
     * @param bool   $expected
     */
    public function testOrbitInclinationIsValid(string $orbitInclination, bool $expected): void
    {
        $this->assertEquals($expected, TleUtilities::orbitInclinationIsValid($orbitInclination));
    }

    /**
     * @return array
     */
    public function orbitInclinationIsValidProducer(): array
    {
        // Todo
        return [
            ['foo', true],
        ];
    }

    /**
     * @dataProvider ascendingNodeIsValidProducer
     *
     * @param string $ascendingNode
     * @param bool   $expected
     */
    public function testAscendingNodeIsValid(string $ascendingNode, bool $expected): void
    {
        $this->assertEquals($expected, TleUtilities::ascendingNodeIsValid($ascendingNode));
    }

    /**
     * @return array
     */
    public function ascendingNodeIsValidProducer(): array
    {
        // Todo
        return [
            ['foo', true],
        ];
    }

    /**
     * @dataProvider eccentricityIsValidProducer
     *
     * @param string $eccentricity
     * @param bool   $expected
     */
    public function testEccentricityIsValid(string $eccentricity, bool $expected): void
    {
        $this->assertEquals($expected, TleUtilities::eccentricityIsValid($eccentricity));
    }

    /**
     * @return array
     */
    public function eccentricityIsValidProducer(): array
    {
        // Todo
        return [
            ['foo', true],
        ];
    }

    /**
     * @dataProvider argumentOfPerigeeIsValidProducer
     *
     * @param string $argumentOfPerigee
     * @param bool   $expected
     */
    public function testArgumentOfPerigeeIsValid(string $argumentOfPerigee, bool $expected): void
    {
        $this->assertEquals($expected, TleUtilities::argumentOfPerigeeIsValid($argumentOfPerigee));
    }

    /**
     * @return array
     */
    public function argumentOfPerigeeIsValidProducer(): array
    {
        // Todo
        return [
            ['foo', true],
        ];
    }

    /**
     * @dataProvider meanAnomalyIsValidProducer
     *
     * @param string $meanAnomaly
     * @param bool   $expected
     */
    public function testMeanAnomalyIsValid(string $meanAnomaly, bool $expected): void
    {
        $this->assertEquals($expected, TleUtilities::meanAnomalyIsValid($meanAnomaly));
    }

    /**
     * @return array
     */
    public function meanAnomalyIsValidProducer(): array
    {
        // Todo
        return [
            ['foo', true],
        ];
    }

    /**
     * @dataProvider meanMotionIsValidProducer
     *
     * @param string $meanMotion
     * @param bool   $expected
     */
    public function testMeanMotionIsValid(string $meanMotion, bool $expected): void
    {
        $this->assertEquals($expected, TleUtilities::meanMotionIsValid($meanMotion));
    }

    /**
     * @return array
     */
    public function meanMotionIsValidProducer(): array
    {
        // Todo
        return [
            ['foo', true],
        ];
    }
}
