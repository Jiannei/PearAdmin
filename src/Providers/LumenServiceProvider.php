<?php

/*
 * This file is part of the Jiannei/laravel-response.
 *
 * (c) Jiannei <longjian.huang@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jiannei\PearAdmin\Providers;

class LumenServiceProvider extends LaravelServiceProvider
{
    public function boot()
    {
        $this->app->configure('pear.admin');
        $this->app->configure('pear.menu');
    }

    protected function setupConfig()
    {
        $path = dirname(__DIR__, 2).'/config/';

        $this->mergeConfigFrom($path.'admin.php', 'pear.admin');
        $this->mergeConfigFrom($path.'menu.php', 'pear.menu');
    }
}
