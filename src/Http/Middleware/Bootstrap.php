<?php

/*
 * This file is part of the jiannei/layadmin.
 *
 * (c) jiannei <longjian.huang@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jiannei\LayAdmin\Http\Middleware;

use Illuminate\Http\Request;
use Jiannei\LayAdmin\Support\Facades\LayAdmin;

class Bootstrap
{
    public function handle(Request $request, \Closure $next)
    {
        $request->merge(['layadmin' => LayAdmin::bootstrap()]);

        return $next($request);
    }
}
