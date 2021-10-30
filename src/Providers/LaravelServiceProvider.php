<?php

namespace Jiannei\LayAdmin\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Jiannei\LayAdmin\View\Components\Layouts\Base;
use Jiannei\LayAdmin\View\Composers\PageComposer;

class LaravelServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(dirname(__DIR__, 2).'/config/layadmin.php', 'lay-admin');

        if ($this->app->runningInConsole()) {
            $this->publishes([dirname(__DIR__, 2).'/resources/assets' => public_path('lay-admin')], 'lay-admin-assets');
            $this->publishes([dirname(__DIR__, 2).'/samples' => public_path('admin')], 'lay-admin-samples');

            $this->publishes([
                dirname(__DIR__, 2).'/config/layadmin.php' => config_path('layadmin.php'),
            ], 'lat-admin-config');

            $this->publishes([
                dirname(__DIR__, 2).'/src/View/Components/' => app_path('View/Components'),
                dirname(__DIR__, 2).'/resources/views/components/' => resource_path('views/components'),
            ], 'lay-admin-components');
        }
    }

    public function boot()
    {
        View::composer('*', PageComposer::class);

        $this->loadViewComponentsAs('lay', [
            Base::class,
        ]);
    }
}
