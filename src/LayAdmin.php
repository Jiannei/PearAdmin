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

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Jiannei\LayAdmin\Contracts\Config;
use Jiannei\LayAdmin\Exceptions\InvalidPageConfigException;

class LayAdmin
{
    /** @var Config */
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Lay Admin version.
     *
     * @return string
     */
    public function version(): string
    {
        return 'v3.0.0';
    }

    /**
     * 检查是否为 admin 路由.
     *
     * @param  string  $path
     * @return bool
     */
    public function isAdminRoute(string $path): bool
    {
        return Str::startsWith($path, config('layadmin.routes.web.prefix'));
    }

    /**
     * 根据请求路径获取页面 uri.
     *
     * @param  string  $path
     * @return string
     */
    public function getPageUri(string $path): string
    {
        return Str::replaceFirst(config('layadmin.routes.web.prefix').'/', '', $path);
    }

    /**
     * 根据请求路径解析页面配置.
     *
     * @param  string|null  $path
     * @return array
     *
     * @throws InvalidPageConfigException
     */
    public function getPageConfig(string $path = null): array
    {
        if (! $this->isAdminRoute($path)) {
            return [];
        }

        $fileConfigs = $this->config->parse();
        if (is_null($path)) {
            return $fileConfigs;
        }

        return Arr::get(array_column($fileConfigs, null, 'uri'), $this->getPageUri($path), []);
    }

    /**
     * 初始化视图依赖的数据.
     *
     * @return array
     *
     * @throws InvalidPageConfigException
     */
    public function bootstrap(): array
    {
        return [
            'version' => $this->version(),
            'params' => request()->all() ?: (object) [],
            'page' => $this->getPageConfig(request()->path()),
        ];
    }

    /**
     * 渲染后台视图.
     *
     * @return Closure
     */
    public function view(): Closure
    {
        return function () {
            if (! ($view = request('layadmin.page.view')) || ! View::exists($view)) {
                return \view('layadmin::errors.404');
            }

            return \view($view);
        };
    }
}
