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
        return 'v2.4.0';
    }

    /**
     * 获取视图页面配置.
     *
     * @return array|\ArrayAccess|mixed
     *
     * @throws InvalidPageConfigException
     */
    public function getPageConfig()
    {
        $configPath = $this->getPageConfigPath();

        try {
            return json_decode(file_get_contents($configPath), true, 512, JSON_THROW_ON_ERROR) ?? [];
        } catch (\JsonException $exception) {
            throw new InvalidPageConfigException('View config json file parse error：'.$exception->getMessage());
        }
    }

    /**
     * 获取视图配置文件的路径.
     *
     * @return string
     *
     * @throws InvalidPageConfigException
     */
    public function getPageConfigPath()
    {
        $paths = explode('/', optional(request())->path());

        if (current($paths) !== config('layadmin.path_prefix')) {
            throw new InvalidPageConfigException("Route path prefix error.");
        }

        array_splice($paths, 1, 0, 'config');

        $pageConfigPath = base_path('public/').collect($paths)->map(function ($path) {
                return explode('.', $path);
            })->flatten()->join(DIRECTORY_SEPARATOR).'.json';

        if (!file_exists($pageConfigPath)) {
            throw new InvalidPageConfigException("View config json file [$pageConfigPath] not exist.");
        }

        return $pageConfigPath;
    }
}
