<?php
declare(strict_types=1);

namespace Alk\TLE\DTO\Builder\Abstraction;

use Alk\TLE\DTO\Abstraction\DTOInterface;

interface DTOBuilderInterface
{
    public function buildFromString(string $string): DTOInterface;
}
