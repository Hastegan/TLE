<?php
declare(strict_types=1);

namespace Hastegan\Tle\Exception;

use UnexpectedValueException;

class TleLineWithNoChecksumLengthException extends UnexpectedValueException
{
    public function __construct()
    {
        parent::__construct('A Two Line Element line without a checksum must be 68 characters long.');
    }
}
