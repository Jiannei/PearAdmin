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
use Illuminate\Support\Str;
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
     * 根据请求路径解析页面配置.
     *
     * @param  string|null  $path
     * @return array
     *
     * @throws InvalidPageConfigException
     */
    public function getPageConfig(string $path)
    {
        $prefix = config('layadmin.path.prefix');

        if (! Str::startsWith($path, $prefix)) {
            return [];
        }

        $pageConfigPath = resource_path('config'.Str::remove($prefix, $path).'.json');
        if (! file_exists($pageConfigPath)) {
            throw new InvalidPageConfigException("页面配置解析错误：配置文件[$pageConfigPath]不存在");
        }

        try {
            $pageConfig = json_decode(file_get_contents($pageConfigPath), true, 512, JSON_THROW_ON_ERROR);

            return array_merge([
                'id' => Str::replace('.', '-', $pageConfig['view']),
                'view' => $pageConfig['view'],
                'styles' => [],
                'scripts' => [],
                'components' => [],
            ], $pageConfig);
        } catch (\Throwable $exception) {
            throw new InvalidPageConfigException('页面配置解析错误：[错误]'.$exception->getMessage().'；[配置文件]'.$pageConfigPath);
        }
    }

    /**
     * 初始化页面配置
     *
     * @return void
     * @throws InvalidPageConfigException
     */
    public function setupConfig()
    {
        $layadmin = array_merge(\config('layadmin'), [
            'version' => LayAdmin::version(),
            'request' => request()->all() ?: (object)[],
            'page' => $this->getPageConfig(request()->path()),
        ]);

        config(compact('layadmin'));
    }

    /**
     * 渲染后台视图
     *
     * @return \Closure
     */
    public function view()
    {
        return function () {
            if (!($view = config('layadmin.page.view')) || !View::exists($view)) {
                return \view('layadmin::errors.404');
            }

            return \view($view);
        };
    }
}
