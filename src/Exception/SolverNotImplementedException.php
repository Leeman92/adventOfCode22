<?php

namespace App\Exception;

use Exception;

class SolverNotImplementedException extends Exception
{
    protected const EXCEPTION_MESSAGE = "Solver for day %s was not implemented yet!";
    // Redefine the exception so message isn't optional
    public function __construct($filename, $code = 0, Throwable $previous = null) {
        $message = sprintf(self::EXCEPTION_MESSAGE, $filename);
        parent::__construct($message, $code, $previous);
    }
}