<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class InternalServerErrorException extends Exception
{
    public function __construct($message, $code = 500)
    {
        parent::__construct($message, $code);
    }
}
