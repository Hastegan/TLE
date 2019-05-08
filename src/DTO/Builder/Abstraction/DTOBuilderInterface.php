<?php
declare(strict_types=1);

namespace Hastegan\Tle\DTO\Builder\Abstraction;

use Hastegan\Tle\DTO\Abstraction\DTOInterface;

interface DTOBuilderInterface
{
    public function buildFromString(string $string): DTOInterface;
}
