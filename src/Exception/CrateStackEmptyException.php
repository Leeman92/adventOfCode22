<?php

namespace App\Exception;

use Exception;

class CrateStackEmptyException extends \Exception
{
    protected const DEFAULT_EXCEPTION_MESSAGE = 'You try to get the first Crate of an empty CrateStack!';

    // Redefine the exception so message isn't optional
    public function __construct(string $message = '', int $code = 0, \Throwable $previous = null)
    {
        if ('' === $message) {
            $message = self::DEFAULT_EXCEPTION_MESSAGE;
        }
        parent::__construct($message, $code, $previous);
    }
}
