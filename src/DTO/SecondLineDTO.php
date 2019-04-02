<?php
declare(strict_types=1);

namespace Alk\TLE\DTO;

use Alk\TLE\DTO\Abstraction\DTOInterface;

class SecondLineDTO implements DTOInterface
{
    /**
     * @var int
     */
    protected $satelliteNumber;

    /**
     * @var string
     */
    protected $inclination;

    /**
     * @var string
     */
    protected $ascendingNodeLongitude;

    /**
     * @var string
     */
    protected $eccentricity;

    /**
     * @var string
     */
    protected $argumentOfPerigee;

    /**
     * @var string
     */
    protected $meanAnomaly;

    /**
     * @var string
     */
    protected $meanMotion;

    /**
     * @var int
     */
    protected $revolutionNumber;

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
     * @return SecondLineDTO
     */
    public function setSatelliteNumber(int $satelliteNumber): SecondLineDTO
    {
        $this->satelliteNumber = $satelliteNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getInclination(): string
    {
        return $this->inclination;
    }

    /**
     * @param string $inclination
     *
     * @return SecondLineDTO
     */
    public function setInclination(string $inclination): SecondLineDTO
    {
        $this->inclination = $inclination;

        return $this;
    }

    /**
     * @return string
     */
    public function getAscendingNodeLongitude(): string
    {
        return $this->ascendingNodeLongitude;
    }

    /**
     * @param string $ascendingNodeLongitude
     *
     * @return SecondLineDTO
     */
    public function setAscendingNodeLongitude(string $ascendingNodeLongitude): SecondLineDTO
    {
        $this->ascendingNodeLongitude = $ascendingNodeLongitude;

        return $this;
    }

    /**
     * @return string
     */
    public function getEccentricity(): string
    {
        return $this->eccentricity;
    }

    /**
     * @param string $eccentricity
     *
     * @return SecondLineDTO
     */
    public function setEccentricity(string $eccentricity): SecondLineDTO
    {
        $this->eccentricity = $eccentricity;

        return $this;
    }

    /**
     * @return string
     */
    public function getArgumentOfPerigee(): string
    {
        return $this->argumentOfPerigee;
    }

    /**
     * @param string $argumentOfPerigee
     *
     * @return SecondLineDTO
     */
    public function setArgumentOfPerigee(string $argumentOfPerigee): SecondLineDTO
    {
        $this->argumentOfPerigee = $argumentOfPerigee;

        return $this;
    }

    /**
     * @return string
     */
    public function getMeanAnomaly(): string
    {
        return $this->meanAnomaly;
    }

    /**
     * @param string $meanAnomaly
     *
     * @return SecondLineDTO
     */
    public function setMeanAnomaly(string $meanAnomaly): SecondLineDTO
    {
        $this->meanAnomaly = $meanAnomaly;

        return $this;
    }

    /**
     * @return string
     */
    public function getMeanMotion(): string
    {
        return $this->meanMotion;
    }

    /**
     * @param string $meanMotion
     *
     * @return SecondLineDTO
     */
    public function setMeanMotion(string $meanMotion): SecondLineDTO
    {
        $this->meanMotion = $meanMotion;

        return $this;
    }

    /**
     * @return int
     */
    public function getRevolutionNumber(): int
    {
        return $this->revolutionNumber;
    }

    /**
     * @param int $revolutionNumber
     *
     * @return SecondLineDTO
     */
    public function setRevolutionNumber(int $revolutionNumber): SecondLineDTO
    {
        $this->revolutionNumber = $revolutionNumber;

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
     * @return SecondLineDTO
     */
    public function setChecksum(int $checksum): SecondLineDTO
    {
        $this->checksum = $checksum;

        return $this;
    }
}
