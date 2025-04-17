<?php

namespace App\Exceptions;

use Exception;

class BusinessLogicException extends Exception
{
    public function __construct(
        string $message = "Business logic error",
        int $code = 422
    )
    {
        parent::__construct($message, $code);
    }
}
