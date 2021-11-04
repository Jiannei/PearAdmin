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

use Illuminate\Support\Facades\Config;
use Jiannei\LayAdmin\Exceptions\InvalidPageConfigException;
use Jiannei\LayAdmin\Exceptions\InvalidPagePathException;

class LayAdmin
{
    /**
     * Lay Admin version.
     *
     * @return string
     */
    public function version()
    {
        return 'v2.3.2';
    }

    /**
     * 获取页面的唯一ID.
     *
     * @return string
     *
     * @throws InvalidPagePathException
     */
    public function getPageUid()
    {
        return 'LAY-'.implode('-', $this->getPagePath());
    }

    /**
     * 获取视图页面配置.
     *
     * @return array|\ArrayAccess|mixed
     *
     * @throws InvalidPageConfigException
     * @throws InvalidPagePathException
     */
    public function getPageConfig(string $path = null)
    {
        $configPath = $this->getPageConfigPath($path);

        try {
            return json_decode(file_get_contents($configPath), true, 512, JSON_THROW_ON_ERROR) ?? [];
        } catch (\JsonException $exception) {
            throw new InvalidPageConfigException('视图配置解析错误：'.$exception->getMessage());
        }
    }

    /**
     * 获取视图配置文件的路径.
     *
     * @param  string|null  $path
     * @return string
     *
     * @throws InvalidPageConfigException
     * @throws InvalidPagePathException
     */
    public function getPageConfigPath(string $path = null)
    {
        if (is_null($path)) {
            $pagePath = $this->getPagePath();
            $path = implode(DIRECTORY_SEPARATOR, $pagePath);
        } else {
            $path = implode(DIRECTORY_SEPARATOR, explode('.', $path));
        }

        if (! file_exists($pageConfigPath = resource_path("views/config/{$path}.json"))) {
            throw new InvalidPageConfigException("视图配置文件[views/config/{$path}.json]不存在");
        }

        return $pageConfigPath;
    }

    /**
     * 获取页面的视图路径.
     *
     * @return mixed
     *
     * @throws InvalidPagePathException
     */
    protected function getPagePath()
    {
        $segments = optional(request())->segments();

        if (count($segments) < 2 || ! isset($segments[0]) || $segments[0] !== Config::get('layadmin.path_prefix', 'admin')) {
            throw new InvalidPagePathException('视图路径前缀错误');
        }

        array_shift($segments);

        return $segments;
    }
}
