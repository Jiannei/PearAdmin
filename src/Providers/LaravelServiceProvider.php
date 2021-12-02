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

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Jiannei\LayAdmin\Support\Facades\LayAdmin;

class LaravelServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(dirname(__DIR__, 2).'/config/layadmin.php', 'layadmin');

        if ($this->app->runningInConsole()) {
            $this->publishes([dirname(__DIR__, 2).'/resources/assets' => public_path('vendor/layadmin')], 'layadmin-assets');
            $this->publishes([dirname(__DIR__, 2).'/samples' => public_path('admin')], 'layadmin-samples');

            $this->publishes([
                dirname(__DIR__, 2).'/config/layadmin.php' => config_path('layadmin.php'),
                dirname(__DIR__, 2).'/resources/config' => resource_path('config'),
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
        $layadmin = \config('layadmin');
        $requestPath = $this->app['request']->path();

        try {
            $referer = $this->app['request']->headers->get('referer', '');
            $refererUrl = parse_url($referer);

            $layadmin = array_merge($layadmin, [
                'version' => LayAdmin::version(),
                'referer' => ltrim($refererUrl['path'], DIRECTORY_SEPARATOR),
                'request' => $this->app['request']->all() ?: (object) [],
                'page' => LayAdmin::getPageConfig($requestPath),
            ]);
        } catch (\Throwable $exception) {
            $errors = ['page' => $exception->getMessage()];

            View::composer('layadmin::errors.*', function (\Illuminate\View\View $view) use ($errors) {
                $view->withErrors($errors, 'layadmin');
            });

            Log::channel(\config('layadmin.log.debug.channel'))->debug('layadmin', ['path'=>$requestPath, 'exception' => $exception->getMessage()]);
        }

        $this->app['config']->set(compact('layadmin'));
    }
}
