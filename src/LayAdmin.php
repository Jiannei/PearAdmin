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
        return 'v2.4.1';
    }

    /**
     * Lay Admin 配置
     *
     * @return array
     * @throws InvalidPageConfigException
     */
    public function getConfig()
    {
        $referer = request()->headers->get('referer', request('referer'));
        $refererUrl = parse_url($referer);

       return array_merge(\config('layadmin'), [
            'version' => $this->version(),
            'request' => optional(request())->all() ?: (object) [],
            'referer' => ltrim($refererUrl['path'], DIRECTORY_SEPARATOR),
            'page' => $this->getPageConfig(),
        ]);
    }

    /**
     * 获取视图页面配置.
     *
     * @param  string|null  $path
     * @return array|\ArrayAccess|mixed
     *
     * @throws InvalidPageConfigException
     */
    public function getPageConfig(string $path = null)
    {
        $configPath = $this->getPageConfigPath($path);

        try {
            return array_merge([
                'styles' => [],
                'scripts' => [],
                'components' => [],
            ], require($configPath));
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
    public function getPageConfigPath(string $path = null)
    {
        $requestPath = $path ?: optional(request())->path();
        $paths = explode('/', $requestPath);

        if (current($paths) !== config('layadmin.path_prefix')) {
            throw new InvalidPageConfigException('Route path prefix error.');
        }

        $viewPath = end($paths);
        if (!View::exists($viewPath)) {
            $viewPath = 'errors.404';
        }

        $configPath = implode(DIRECTORY_SEPARATOR, explode('.', $viewPath));
        $pageConfigPath = resource_path('config/'.$configPath.'.php');

        if (!file_exists($pageConfigPath)) {
            throw new InvalidPageConfigException("View config file [$pageConfigPath] not exist.");
        }

        return $pageConfigPath;
    }
}
