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
    private $layAdmin = [];

    public function register()
    {
        $this->mergeConfigFrom(dirname(__DIR__, 2).'/config/layadmin.php', 'layadmin');

        if ($this->app->runningInConsole()) {
            $this->publishes([dirname(__DIR__, 2).'/resources/assets' => public_path('layadmin')], 'layadmin-assets');
            $this->publishes([dirname(__DIR__, 2).'/samples' => public_path('admin')], 'layadmin-samples'); // todo config('layadmin.path_prefix')

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
        $this->loadViewsFrom(dirname(__DIR__, 2).'/resources/views', 'layadmin');

        $this->setupViewData();
    }

    protected function setupViewData()
    {
        View::composer('layadmin::components.*', function (\Illuminate\View\View $view) {
            if (! $this->layAdmin) {
                $page = array_merge([
                    'styles' => [],
                    'scripts' => [],
                    'components' => [],
                ], LayAdmin::getPageConfig());

                $this->layAdmin = array_merge(Config::get('layadmin'), [
                    'version' => LayAdmin::version(),
                    'request' => optional(request())->all() ?: (object) [],
                    'page' => $page,
                ]);
            }

            $view->with(['layadmin' => $this->layAdmin]);
        });
    }
}
