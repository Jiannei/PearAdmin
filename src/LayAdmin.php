<?php

/*
 * This file is part of the jiannei/layadmin.
 *
 * (c) jiannei <longjian.huang@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jiannei\LayAdmin;

use Illuminate\Support\Facades\View;
use Jiannei\LayAdmin\Exceptions\InvalidPageConfigException;

class LayAdmin
{
    /**
     * Lay Admin version.
     *
     * @return string
     */
    public function version()
    {
        return 'v3.0.0';
    }

    /**
     * 获取视图页面配置.
     *
     * @param  string|null  $path
     * @return array
     *
     * @throws InvalidPageConfigException
     */
    public function getPageConfig(string $path)
    {
        $configPath = $this->getPageConfigPath($path);

        try {
            return json_decode(file_get_contents($configPath), true, 512, JSON_THROW_ON_ERROR);
        } catch (\Throwable $exception) {
            throw new InvalidPageConfigException('View config parse error：'.$exception->getMessage());
        }
    }

    /**
     * 获取视图配置文件的路径.
     *
     * @param  string|null  $path
     * @return string
     *
     * @throws InvalidPageConfigException
     */
    public function getPageConfigPath(string $path)
    {
        $paths = explode('/', $path);
        if (current($paths) !== config('layadmin.path_prefix')) {
            throw new InvalidPageConfigException('Route path prefix error.');
        }

        $viewPath = end($paths);
        if (! View::exists($viewPath)) {
            $viewPath = 'errors.404';
        }

        $configPath = implode(DIRECTORY_SEPARATOR, explode('.', $viewPath));
        $pageConfigPath = resource_path('config/'.$configPath.'.json');

        if (! file_exists($pageConfigPath)) {
            throw new InvalidPageConfigException("View config file [$pageConfigPath] not exist.");
        }

        return $pageConfigPath;
    }
}
