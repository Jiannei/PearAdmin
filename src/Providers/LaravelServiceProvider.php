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
            $this->publishes([dirname(__DIR__, 2).'/samples' => resource_path('views/admin-sample')], 'samples');
        }

        $this->mergeConfigFrom($adminPath, 'pear');
        $this->mergeConfigFrom($menuPath, 'pear');
    }
}
