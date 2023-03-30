<?php

/*
 * This file is part of the jiannei/layadmin.
 *
 * (c) jiannei <longjian.huang@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jiannei\LayAdmin\Support;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Jiannei\LayAdmin\Exceptions\InvalidPageConfigException;
use Throwable;

class Config implements \Jiannei\LayAdmin\Contracts\Config
{
    /**
     * 解析并校验页面配置.
     *
     * @param  string  $path
     * @return array
     *
     * @throws InvalidPageConfigException
     */
    public function parse(string $path): array
    {
        $prefix = config('layadmin.routes.web.prefix');
        $configPath = trim(Str::remove($prefix, request()->path()), '/');

        if (! Str::startsWith($path, $prefix) || ! File::exists(resource_path("config/{$configPath}.json"))) {
            return [];
        }

        try {
            $config = json_decode(File::get(resource_path("config/{$configPath}.json")), true, 512, JSON_THROW_ON_ERROR);

            $this->valid($configPath, $config);
        } catch (Throwable $e) {
            throw new InvalidPageConfigException("[{$configPath}]解析错误：{$e->getMessage()}");
        }

        return array_merge([
            'id' => Str::replace(DIRECTORY_SEPARATOR, '-', $config['uri']),
            'title' => Arr::get($config, 'title', config('layadmin.title')),
            'styles' => [],
            'scripts' => [],
            'components' => [],
        ], $config);
    }

    /**
     * 校验配置项.
     *
     * @param  string  $key
     * @param  array  $config
     *
     * @throws InvalidPageConfigException
     */
    protected function valid(string $key, array $config): void
    {
        // todo 配置校验；table\form 处理
        if (! Arr::has($config, 'uri')) {
            throw new InvalidPageConfigException("[{$key}]缺少 uri 配置项");
        }
    }
}
