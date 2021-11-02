<?php

/*
 * This file is part of the jiannei/layadmin.
 *
 * (c) jiannei <longjian.huang@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jiannei\LayAdmin\Exceptions;

class InvalidTableConfigException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message, 403);
    }
}
