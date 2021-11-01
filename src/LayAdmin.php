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
use Jiannei\LayAdmin\Exceptions\InvalidPageConfException;
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
        return 'v2.2.0';
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
     * @throws InvalidPageConfException
     * @throws InvalidPagePathException
     */
    public function getPageConfig(string $confPath = null)
    {
        if (is_null($confPath)) {
            $pagePath = $this->getPagePath();
            $confPath = implode(DIRECTORY_SEPARATOR, $pagePath);
        } else {
            $confPath = implode(DIRECTORY_SEPARATOR, explode('.', $confPath));
        }

        if (! file_exists($conf = resource_path("config/{$confPath}.json"))) {
            throw new InvalidPageConfException('视图配置文件不存在');
        }

        return json_decode(file_get_contents($conf), true) ?? [];
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
        $pagePathPrefix = Config::get('layadmin.page_path_prefix', 'page');

        $segments = optional(request())->segments();
        if (count($segments) < 2 || ! isset($segments[0]) || $segments[0] !== $pagePathPrefix) {
            throw new InvalidPagePathException('视图路径前缀错误');
        }

        array_shift($segments);

        return $segments;
    }
}
