<?php

namespace App\Services\Yandex\Direct\Exceptions;

use Exception;

class ApiException extends Exception
{
    protected $context = [];

    public function __construct($message = "", $code = 0, $context = [])
    {
        parent::__construct($message, $code);
        $this->context = $context;
    }

    public function getContext()
    {
        return $this->context;
    }
} 