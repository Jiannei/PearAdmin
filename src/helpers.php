<?php

if (!function_exists('pear_version')) {
    /**
     * Get Pear Admin version
     *
     * @return string
     */
    function pear_version()
    {
        return app(\Jiannei\PearAdmin\Pear::class)->version();
    }
}