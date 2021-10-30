<?php

namespace Jiannei\LayAdmin\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Jiannei\LayAdmin\View\Composers\PageComposer;

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
                dirname(__DIR__, 2).'/src/View/Components/' => app_path('View/Components'),
                dirname(__DIR__, 2).'/resources/views/components/' => resource_path('views/components'),
            ], 'layadmin-components');
        }
    }

    public function boot()
    {
        View::composer('*', PageComposer::class);

        $this->loadViewsFrom(dirname(__DIR__, 2).'/resources/views', 'layadmin');
    }
}
