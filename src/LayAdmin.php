<?php

namespace Jiannei\LayAdmin;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class LayAdmin
{
    /**
     * Lay Admin version
     *
     * @return string
     */
    public function version()
    {
        return 'v1.0.4';
    }

    /**
     * Gets the unique ID of the page
     *
     * @return string
     */
    public function getPageUid()
    {
        return 'LAY-'.Str::replace('.', '-', Route::currentRouteName());
    }

    /**
     * Get page configurations
     *
     * @return array|\ArrayAccess|mixed
     */
    public function getPageConf()
    {
        return Arr::get(config('layadmin'), 'page.'.Route::currentRouteName(), []);
    }
}