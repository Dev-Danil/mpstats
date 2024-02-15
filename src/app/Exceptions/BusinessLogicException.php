<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class BusinessLogicException extends Exception
{
    public function __construct($message, $code = 400)
    {
        parent::__construct($message, $code);
    }
}
