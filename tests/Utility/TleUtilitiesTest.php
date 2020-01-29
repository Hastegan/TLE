<?php
declare(strict_types=1);

namespace Platerre\Tle\Tests\Utility;

use Platerre\Tle\Exception\TleLineWithNoChecksumLengthException;
use Platerre\Tle\Utility\TleUtilities;
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
        return [
            ['00001', true],
            ['00001', true],
            ['98067', true],
            ['01001', true],
            ['', false],
            ['98', false],
            ['98000', false],
            ['98  1', false],
            ['way too long', false],
            ['a0000', false],
            ['00000', false],
            ['98067A', false],
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
        return [
            ['', true],
            ['A', true],
            ['BA', true],
            ['ABC', true],
            ['AAAA', false],
            ['1', false],
            ['-', false],
            ['*', false],
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
        return [
            ['00000.00000000', true],
            ['98001.00000010', true],
            ['98  1.00000010', true],
            ['12365.50000000', true],
            ['', false],
            ['00000000000000', false],
            ['00000.000000000', false],
            ['00000.0', false],
            ['0.000000000', false],
            ['a0000.00000000', false],
            [' 1000.00000000', false],
            ['01367.00000000', false],
            ['11365.50000000', false],
            ['11   .50000000', false],
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
        return [
            ['+.00000000', true],
            ['-.00000000', true],
            [' .00000000', true],
            ['00000000', false],
            ['+.00      ', false],
            ['+.0000000a', false],
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
        return [
            ['00000-0', true],
            ['0000-0', false],
            ['000000-0', false],
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
        return [
            ['38310-4', true],
            ['00000-0', true],
            ['0000000', false],
            ['00000-', false],
            ['00000-00', false],
            ['      0', false],
            ['    0-0', false],
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
        return [
            ['0', true],
            ['', false],
            ['00', false],
            ['1', false],
            ['1', false],
            ['a', false],
        ];
    }

    /**
     * @dataProvider elementSetNumberIsValidProvider
     *
     * @param string $elementSetNumber
     * @param bool   $expected
     */
    public function testElementSetNumberIsValid(string $elementSetNumber, bool $expected): void
    {
        $this->assertEquals($expected, TleUtilities::elementSetNumberIsValid($elementSetNumber));
    }

    /**
     * @return array
     */
    public function elementSetNumberIsValidProvider(): array
    {
        return [
            ['  1', true],
            [' 91', true],
            ['999', true],
            ['  0', false],
            ['   ', false],
            ['  a', false],
            ['aaa', false],
            ['9999', false],
            ['99', false],
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
        return [
            ['50.0000', true],
            ['01.0000', true],
            [' 1.0000', true],
            [' 0.0001', true],
            ['0.0000', false],
            ['5000000', false],
            ['aa.0000', false],
            [' 0.aaaa', false],
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
        return [
            ['001.1234', true],
            ['  1.1234', true],
            ['100.1234', true],
            ['360.0000', true],
            ['361.0000', false],
            ['36100000', false],
            ['1.0000', false],
            ['361.00001', false],
            ['  a.aaaaa', false],
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
        return [
            ['0000000', true],
            ['0000007', true],
            ['0000000', true],
            ['00000000', false],
            ['000000', false],
            ['aaaaaaa', false],
            ['       ', false],
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
        return [
            ['001.1234', true],
            ['  1.1234', true],
            ['100.1234', true],
            ['360.0000', true],
            ['361.0000', false],
            ['36100000', false],
            ['1.0000', false],
            ['361.00001', false],
            ['  a.aaaaa', false],
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
        return [
            ['001.1234', true],
            ['  1.1234', true],
            ['100.1234', true],
            ['360.0000', true],
            ['361.0000', false],
            ['36100000', false],
            ['1.0000', false],
            ['361.00001', false],
            ['  a.aaaaa', false],
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
        return [
            ['15.72125391', true],
            ['01.72125391', true],
            [' 1.72125391', true],
            ['00.72125391', true],
            ['  .72125391', false],
            ['1.72125391', false],
            ['10.782125391', false],
            ['aa.72125391', false],
            ['10.aaaaaaaa', false],
        ];
    }
}
