<?php
declare(strict_types=1);

namespace Platerre\Tle\Exception;

use UnexpectedValueException;

class TleLineLengthException extends UnexpectedValueException
{
    public function __construct()
    {
        parent::__construct('A Two Line Element line must be 69 characters long.');
    }
}
