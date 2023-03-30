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
use Illuminate\Support\Facades\View;
use Jiannei\LayAdmin\Contracts\Config;

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
     * 初始化视图依赖的数据.
     *
     * @return array
     */
    public function bootstrap(): array
    {
        return [
            'version' => $this->version(),
            'params' => request()->all() ?: (object) [],
            'page' => $this->config->parse(request()->route('path')),
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
