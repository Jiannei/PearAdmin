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

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Jiannei\LayAdmin\Http\Middleware\Bootstrap;
use Jiannei\LayAdmin\Support\Facades\LayAdmin;

class LaravelServiceProvider extends ServiceProvider
{
    /**
     * The middleware aliases.
     *
     * @var array
     */
    protected $middlewareAliases = [
        'admin.bootstrap' => Bootstrap::class,
    ];

    /**
     * The middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'admin' => [
            'admin.bootstrap',
        ],
    ];

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

        $this->aliasMiddleware();

        $this->ensureHttps();
    }

    /**
     * Force setting https scheme if https enabled.
     *
     * @return void
     */
    protected function ensureHttps(): void
    {
        if (config('layadmin.https') && LayAdmin::isAdminRoute(request()->path())) {
            URL::forceScheme('https');
            request()->server->set('HTTPS', true);
        }
    }

    /**
     * Alias the middleware.
     *
     * @return void
     */
    protected function aliasMiddleware()
    {
        foreach ($this->middlewareAliases as $alias => $middleware) {
            $this->app['router']->aliasMiddleware($alias, $middleware);
        }

        foreach ($this->middlewareGroups as $group => $middleware) {
            $this->app['router']->middlewareGroup($group, $middleware);
        }
    }
}
