<?php

namespace Jiannei\LayAdmin\Providers;


class LumenServiceProvider extends LaravelServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(dirname(__DIR__, 2).'/config/layadmin.php', 'layadmin');
    }

    public function boot()
    {
        $this->setupViewData();

        $this->loadViewsFrom(dirname(__DIR__, 2).'/resources/views', 'layadmin');
    }
}