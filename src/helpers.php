<?php

/*
 * This file is part of the jiannei/layadmin.
 *
 * (c) jiannei <longjian.huang@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

if (! function_exists('lay_admin_version')) {
    /**
     * Get Lay Admin version.
     *
     * @return string
     */
    function lay_admin_version()
    {
        return app(\Jiannei\LayAdmin\LayAdmin::class)->version();
    }
}
