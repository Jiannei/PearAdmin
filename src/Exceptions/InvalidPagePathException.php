<?php

namespace Jiannei\LayAdmin\Exceptions;


class InvalidPagePathException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message, 403);
    }
}