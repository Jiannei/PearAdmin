<?php

namespace Jiannei\LayAdmin\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->setupConfig();
    }

    protected function setupConfig()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([dirname(__DIR__, 2).'/resources' => public_path('pear')], 'assets');

            $this->publishes([dirname(__DIR__, 2).'/samples' => public_path('admin')], 'samples');
        }
    }
}
