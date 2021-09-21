<?php

namespace Jiannei\PearAdmin\Support\Facades;

use Illuminate\Support\Facades\Facade as LaravelFacade;

/**
 * @method static version()
 * @method static config($key = null, $default = null)
 * @see \Jiannei\PearAdmin\Pear
 */
class Pear extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return \Jiannei\PearAdmin\Pear::class;
    }
}