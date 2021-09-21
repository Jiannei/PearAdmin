<?php

namespace Jiannei\PearAdmin;

use Illuminate\Support\Facades\URL;

class Pear
{
    /**
     * Pear Admin version
     *
     * @return string
     */
    public function version()
    {
        return 'Pear Admin v3.9.0';
    }

    /**
     * Get / set the specified configuration value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  array|string|null  $key
     * @param  mixed  $default
     * @return mixed|\Illuminate\Config\Repository
     */
    public function config($key = null, $default = null)
    {
        $prefix = 'pear.';

        return config($prefix.$key, $default);
    }

    /**
     * Generate Pear Admin asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    public function asset(string $path, bool $secure = null)
    {
        return URL::asset($path, $secure);
    }
}