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
            throw new InvalidPageConfigException('视图配置解析错误：'.$exception->getMessage());
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
        $pageConfigPath = base_path('public/').optional(request())->path().'.json';

        if (! file_exists($pageConfigPath)) {
            throw new InvalidPageConfigException("视图配置文件[$pageConfigPath]不存在");
        }

        return $pageConfigPath;
    }
}
