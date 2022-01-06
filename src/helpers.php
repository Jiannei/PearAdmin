<?php

/*
 * This file is part of the jiannei/layadmin.
 *
 * (c) jiannei <longjian.huang@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

if (! function_exists('asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function asset($path, $secure = null)
    {
        return app('url')->asset($path, $secure);
    }
}

if (! function_exists('admin_web_path')) {
    /**
     * admin web route actual path.
     *
     * @param $uri
     * @return string
     */
    function admin_web_path($uri): string
    {
        return \Illuminate\Support\Str::start($uri, config('layadmin.routes.web.prefix').DIRECTORY_SEPARATOR);
    }
}
