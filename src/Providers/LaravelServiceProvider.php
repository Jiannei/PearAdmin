<?php

namespace Jiannei\PearAdmin\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->setupConfig();
    }

    protected function setupConfig()
    {
        $basePath = dirname(__DIR__, 2).'/config/';

        $adminPath = $basePath.'admin.php';
        $menuPath = $basePath.'menu.php';

        if ($this->app->runningInConsole()) {
            $this->publishes([$adminPath => config_path('pear/admin.php')], 'pear');
            $this->publishes([$menuPath => config_path('pear/admin.php')], 'pear');
            $this->publishes([dirname(__DIR__, 2).'/resources/assets' => public_path('pear')], 'assets');

            $this->publishes([dirname(__DIR__, 2).'/samples/config' => public_path('admin-sample/config')], 'samples');
            $this->publishes([dirname(__DIR__, 2).'/samples/css' => public_path('admin-sample/css')], 'samples');
            $this->publishes([dirname(__DIR__, 2).'/samples/data' => public_path('admin-sample/data')], 'samples');
            $this->publishes([dirname(__DIR__, 2).'/samples/images' => public_path('admin-sample/images')], 'samples');
            $this->publishes([dirname(__DIR__, 2).'/samples/views' => resource_path('views/admin-sample')], 'samples');
        }

        $this->mergeConfigFrom($adminPath, 'pear');
        $this->mergeConfigFrom($menuPath, 'pear');
    }
}
