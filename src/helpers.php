<?php

/*
 * This file is part of the jiannei/layadmin.
 *
 * (c) jiannei <longjian.huang@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

if (!function_exists('layadmin_version')) {
    /**
     * Get Lay Admin version.
     *
     * @return string
     */
    function layadmin_version()
    {
        return app(\Jiannei\LayAdmin\LayAdmin::class)->version();
    }
}

if (!function_exists('layadmin_page_config')) {
    /**
     * Get page config.
     *
     * @param $path
     * @return mixed
     */
    function layadmin_page_config($path)
    {
        return app(\Jiannei\LayAdmin\LayAdmin::class)->getPageConfig($path);
    }
}