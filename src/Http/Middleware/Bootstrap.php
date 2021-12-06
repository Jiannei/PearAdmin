<?php

namespace Jiannei\LayAdmin\Http\Middleware;

use Illuminate\Support\Facades\View;
use Jiannei\LayAdmin\Support\Facades\LayAdmin;

class Bootstrap
{
    public function handle($request, \Closure $next)
    {
        $layadmin = LayAdmin::bootstrap();

        View::share('layadmin', $layadmin);

        return $next($request);
    }
}