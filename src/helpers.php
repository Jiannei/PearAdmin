<?php

if (!function_exists('lay_admin_version')) {
    /**
     * Get Lay Admin version
     *
     * @return string
     */
    function lay_admin_version()
    {
        return app(\Jiannei\LayAdmin\LayAdmin::class)->version();
    }
}