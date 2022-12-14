<?php

namespace App\Exception;

use Exception;
use Throwable;

class InputNotFoundException extends Exception
{
    protected const EXCEPTION_MESSAGE = "Could not find file %s";
    // Redefine the exception so message isn't optional
    public function __construct(string $filename, int $code = 0, Throwable $previous = null)
    {
        $message = sprintf(self::EXCEPTION_MESSAGE, $filename);
        parent::__construct($message, $code, $previous);
    }
}
