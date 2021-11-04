<?php

/*
 * This file is part of the jiannei/layadmin.
 *
 * (c) jiannei <longjian.huang@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jiannei\LayAdmin\Providers;

class LumenServiceProvider extends LaravelServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(dirname(__DIR__, 2).'/config/layadmin.php', 'layadmin');
    }

    public function boot()
    {
        $this->setupViewData();

        $this->loadViewsFrom(dirname(__DIR__, 2).'/resources/views', 'layadmin');
    }
}
