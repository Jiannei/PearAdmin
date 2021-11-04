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

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Jiannei\LayAdmin\Support\Facades\LayAdmin;

class LaravelServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(dirname(__DIR__, 2).'/config/layadmin.php', 'layadmin');

        if ($this->app->runningInConsole()) {
            $this->publishes([dirname(__DIR__, 2).'/resources/assets' => public_path('layadmin')], 'layadmin-assets');
            $this->publishes([dirname(__DIR__, 2).'/samples' => public_path('admin')], 'layadmin-samples');

            $this->publishes([
                dirname(__DIR__, 2).'/config/layadmin.php' => config_path('layadmin.php'),
            ], 'layadmin-config');

            $this->publishes([
                dirname(__DIR__, 2).'/resources/views/' => resource_path('views/vendor/layadmin'),
            ], 'layadmin-blades');
        }
    }

    public function boot()
    {
        $this->setupViewData();

        $this->loadViewsFrom(dirname(__DIR__, 2).'/resources/views', 'layadmin');
    }

    protected function setupViewData()
    {
        // todo 待优化
        View::composer('*', function (\Illuminate\View\View $view) {
            $layadmin = array_merge(Config::get('layadmin'), [
                'version' => LayAdmin::version(),
                'request' => optional(request())->all() ?: (object) [],
            ]);

            $page = array_merge([
                'config_path' => LayAdmin::getPageConfigPath(),
                'styles' => [],
                'scripts' => [],
                'components' => [],
            ], LayAdmin::getPageConfig());

            $view->with(compact('layadmin', 'page'));
        });
    }
}
