<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class ApiNotFoundException extends Exception
{
    public function __construct($message, $code = 404)
    {
        parent::__construct($message, $code);
    }
}
