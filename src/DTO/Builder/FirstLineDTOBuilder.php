<?php
declare(strict_types=1);

namespace Hastegan\Tle\DTO\Builder;

use Hastegan\Tle\DTO\Abstraction\DTOInterface;
use Hastegan\Tle\DTO\Builder\Abstraction\DTOBuilderInterface;
use Hastegan\Tle\DTO\FirstLineDTO;

class FirstLineDTOBuilder implements DTOBuilderInterface
{
    /**
     * @inheritdoc
     */
    public function buildFromString(string $line): DTOInterface
    {
        return (new FirstLineDTO())
            ->setSatelliteNumber((int) substr($line, 2, 5))
            ->setClassification($line{7})
            ->setInternationalDesignator(substr($line, 9, 8))
            ->setTwoDigitYear(substr_compare($line, 18, 2))
            ->setEpochDays(substr($line, 20, 12))
            ->setMeanMotionFirstTimeDerivative(substr($line, 33, 10))
            ->setMeanMotionSecondTimeDerivative($line{44} . '.' . substr($line, 45, 5))
            ->setMeanMotionExp((int) substr($line, 50, 2))
            ->setDrag($line{53} . '.' . substr($line, 54, 5))
            ->setDragExp((int) substr($line, 59, 2))
            ->setSetNumber((int) substr($line, 64, 4))
            ->setChecksum((int) $line{69})
        ;
    }
}
