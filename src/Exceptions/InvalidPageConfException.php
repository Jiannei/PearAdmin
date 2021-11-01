<?php

namespace Jiannei\LayAdmin\Exceptions;

class InvalidPageConfException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message, 403);
    }
}