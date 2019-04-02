<?php
declare(strict_types=1);

namespace Alk\TLE\DTO\Builder;

use Alk\TLE\DTO\Abstraction\DTOInterface;
use Alk\TLE\DTO\Builder\Abstraction\DTOBuilderInterface;
use Alk\TLE\DTO\SecondLineDTO;
use Alk\TLE\Utility\StringUtilities;
use UnexpectedValueException;

class SecondLineDTOBuilder implements DTOBuilderInterface
{
    /**
     * @inheritdoc
     */
    public function buildFromString(string $line): DTOInterface
    {
        $charChecks = [
            7  => ' ',
            11 => '.',
            16 => ' ',
            20 => '.',
            25 => ' ',
            33 => ' ',
            37 => '.',
            42 => ' ',
            46 => '.',
            51 => ' ',
        ];

        if (strlen($line) !== 70
            || !StringUtilities::startsWith($line, '2 ')
            || !StringUtilities::checkChars($line, $charChecks)
        ) {
            throw new UnexpectedValueException();
        }

        return (new SecondLineDTO())
            ->setSatelliteNumber((int) substr($line, 2, 5))
            ->setInclination(substr($line, 8, 8))
            ->setAscendingNodeLongitude(substr($line, 17, 8))
            ->setEccentricity('0' . str_replace(' ', '0', substr($line, 26, 7)))
            ->setArgumentOfPerigee(substr($line, 34, 8))
            ->setMeanAnomaly(substr($line, 43, 8))
            ->setMeanMotion(substr($line, 52, 11))
            ->setRevolutionNumber((int) substr_compare($line, 63, 5))
            ->setChecksum((int) $line{70})
        ;
    }
}
