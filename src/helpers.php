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

if (!function_exists('pear_config')) {
    /**
     * Get or set Pear Admin config.
     */
    function pear_config($key = null, $default = null)
    {
        return app(\Jiannei\PearAdmin\Pear::class)->config($key, $default);
    }
}

if (!function_exists('pear_asset')) {
    /**
     * Generate Pear Admin asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */

    function pear_asset(string $path, bool $secure = null)
    {
        return app(\Jiannei\PearAdmin\Pear::class)->asset($path, $secure);
    }
}