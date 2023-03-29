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
use Illuminate\Cache\CacheManager;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Jiannei\LayAdmin\Exceptions\InvalidPageConfigException;
use Throwable;

class LayAdmin
{
    /** @var Repository */
    protected $cache;

    public function __construct(CacheManager $cacheManager)
    {
        $this->cache = $this->getCacheStoreFromConfig($cacheManager);
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
        $cacheConfig = config('layadmin.cache.enable') ? $this->cacheConfig() : $this->parseFileConfig();
        if (is_null($path)) {
            return $cacheConfig;
        }

        if (! $this->isAdminRoute($path)) {
            return [];
        }

        $configs = array_column($cacheConfig, null, 'uri');
        $uri = $this->getPageUri($path);

        return Arr::get($configs, $uri, []);
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
     * 缓存页面配置项.
     *
     * @return mixed
     *
     * @throws InvalidPageConfigException
     */
    protected function cacheConfig()
    {
        try {
            return $this->cache->remember(config('layadmin.cache.key'), config('layadmin.cache.expiration_time'), function () {
                return $this->parseFileConfig();
            });
        } catch (\Throwable $e) {
            throw new InvalidPageConfigException('页面配置错误：'.$e->getMessage());
        }
    }

    /**
     * 解析并校验页面配置.
     *
     * @return array
     */
    protected function parseFileConfig(): array
    {
        return collect(File::allFiles(resource_path('config')))->map(function ($item) {
            $key = $item->getRelativePathname();

            try {
                $config = json_decode($item->getContents(), true, 512, JSON_THROW_ON_ERROR);
            } catch (Throwable $e) {
                throw new InvalidPageConfigException("[{$key}]解析错误：{$e->getMessage()}");
            }

            return $this->validConfig($key, $config);
        })->all();
    }

    /**
     * 校验配置项.
     *
     * @param  string  $key
     * @param  array  $config
     * @return array
     *
     * @throws InvalidPageConfigException
     */
    protected function validConfig(string $key, array $config): array
    {
        // todo 配置校验；table\form 处理
        if (! Arr::has($config, 'uri')) {
            throw new InvalidPageConfigException("[{$key}]缺少 uri 配置项");
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

    /**
     * 获取缓存驱动.
     *
     * @param  CacheManager  $cacheManager
     * @return Repository
     */
    protected function getCacheStoreFromConfig(CacheManager $cacheManager): Repository
    {
        $cacheDriver = config('layadmin.cache.store', 'default');

        if ($cacheDriver === 'default') {
            return $cacheManager->store();
        }

        if (! \array_key_exists($cacheDriver, config('cache.stores'))) {
            $cacheDriver = 'array';
        }

        return $cacheManager->store($cacheDriver);
    }
}
