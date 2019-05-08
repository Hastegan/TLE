<?php
declare(strict_types=1);

namespace Hastegan\Tle\DTO;

use Hastegan\Tle\DTO\Abstraction\DTOInterface;

class FirstLineDTO implements DTOInterface
{
    /**
     * @var int
     */
    protected $satelliteNumber;

    /**
     * @var string
     */
    protected $classification;

    /**
     * @var string
     */
    protected $internationalDesignator;

    /**
     * @var int
     */
    protected $twoDigitYear;

    /**
     * @var string
     */
    protected $epochDays;

    /**
     * @var string
     */
    protected $meanMotionFirstTimeDerivative;

    /**
     * @var string
     */
    protected $meanMotionSecondTimeDerivative;

    /**
     * @var int
     */
    protected $meanMotionExp;

    /**
     * @var string
     */
    protected $drag;

    /**
     * @var int
     */
    protected $dragExp;

    /**
     * Included but never actually used
     *
     * @var int
     */
    protected $ephemerisType = 0;

    /**
     * @var int
     */
    protected $setNumber;

    /**
     * @var int
     */
    protected $checksum;

    /**
     * @return int
     */
    public function getSatelliteNumber(): int
    {
        return $this->satelliteNumber;
    }

    /**
     * @param int $satelliteNumber
     *
     * @return FirstLineDTO
     */
    public function setSatelliteNumber(int $satelliteNumber): FirstLineDTO
    {
        $this->satelliteNumber = $satelliteNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getClassification(): string
    {
        return $this->classification;
    }

    /**
     * @param string $classification
     *
     * @return FirstLineDTO
     */
    public function setClassification(string $classification): FirstLineDTO
    {
        $this->classification = $classification;

        return $this;
    }

    /**
     * @return string
     */
    public function getInternationalDesignator(): string
    {
        return $this->internationalDesignator;
    }

    /**
     * @param string $internationalDesignator
     *
     * @return FirstLineDTO
     */
    public function setInternationalDesignator(string $internationalDesignator): FirstLineDTO
    {
        $this->internationalDesignator = $internationalDesignator;

        return $this;
    }

    /**
     * @return int
     */
    public function getTwoDigitYear(): int
    {
        return $this->twoDigitYear;
    }

    /**
     * @param int $twoDigitYear
     *
     * @return FirstLineDTO
     */
    public function setTwoDigitYear(int $twoDigitYear): FirstLineDTO
    {
        $this->twoDigitYear = $twoDigitYear;

        return $this;
    }

    /**
     * @return string
     */
    public function getEpochDays(): string
    {
        return $this->epochDays;
    }

    /**
     * @param string $epochDays
     *
     * @return FirstLineDTO
     */
    public function setEpochDays(string $epochDays): FirstLineDTO
    {
        $this->epochDays = $epochDays;

        return $this;
    }

    /**
     * @return string
     */
    public function getMeanMotionFirstTimeDerivative(): string
    {
        return $this->meanMotionFirstTimeDerivative;
    }

    /**
     * @param string $meanMotionFirstTimeDerivative
     *
     * @return FirstLineDTO
     */
    public function setMeanMotionFirstTimeDerivative(string $meanMotionFirstTimeDerivative): FirstLineDTO
    {
        $this->meanMotionFirstTimeDerivative = $meanMotionFirstTimeDerivative;

        return $this;
    }

    /**
     * @return string
     */
    public function getMeanMotionSecondTimeDerivative(): string
    {
        return $this->meanMotionSecondTimeDerivative;
    }

    /**
     * @param string $meanMotionSecondTimeDerivative
     *
     * @return FirstLineDTO
     */
    public function setMeanMotionSecondTimeDerivative(string $meanMotionSecondTimeDerivative): FirstLineDTO
    {
        $this->meanMotionSecondTimeDerivative = $meanMotionSecondTimeDerivative;

        return $this;
    }

    /**
     * @return int
     */
    public function getMeanMotionExp(): int
    {
        return $this->meanMotionExp;
    }

    /**
     * @param int $meanMotionExp
     *
     * @return FirstLineDTO
     */
    public function setMeanMotionExp(int $meanMotionExp): FirstLineDTO
    {
        $this->meanMotionExp = $meanMotionExp;

        return $this;
    }

    /**
     * @return string
     */
    public function getDrag(): string
    {
        return $this->drag;
    }

    /**
     * @param string $drag
     *
     * @return FirstLineDTO
     */
    public function setDrag(string $drag): FirstLineDTO
    {
        $this->drag = $drag;

        return $this;
    }

    /**
     * @return int
     */
    public function getDragExp(): int
    {
        return $this->dragExp;
    }

    /**
     * @param int $dragExp
     *
     * @return FirstLineDTO
     */
    public function setDragExp(int $dragExp): FirstLineDTO
    {
        $this->dragExp = $dragExp;

        return $this;
    }

    /**
     * @return int
     */
    public function getEphemerisType(): int
    {
        return $this->ephemerisType;
    }

    /**
     * @param int $ephemerisType
     *
     * @return FirstLineDTO
     */
    public function setEphemerisType(int $ephemerisType): FirstLineDTO
    {
        $this->ephemerisType = $ephemerisType;

        return $this;
    }

    /**
     * @return int
     */
    public function getSetNumber(): int
    {
        return $this->setNumber;
    }

    /**
     * @param int $setNumber
     *
     * @return FirstLineDTO
     */
    public function setSetNumber(int $setNumber): FirstLineDTO
    {
        $this->setNumber = $setNumber;

        return $this;
    }

    /**
     * @return int
     */
    public function getChecksum(): int
    {
        return $this->checksum;
    }

    /**
     * @param int $checksum
     *
     * @return FirstLineDTO
     */
    public function setChecksum(int $checksum): FirstLineDTO
    {
        $this->checksum = $checksum;

        return $this;
    }
}
