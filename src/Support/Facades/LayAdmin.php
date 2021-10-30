<?php

namespace Jiannei\LayAdmin\Support\Facades;

use Illuminate\Support\Facades\Facade as LaravelFacade;

/**
 * @method static version()
 * @see \Jiannei\LayAdmin\LayAdmin
 */
class LayAdmin extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return \Jiannei\LayAdmin\LayAdmin::class;
    }
}