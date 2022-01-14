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
    public function version()
    {
        return 'v3.0.0';
    }

    /**
     * 检查是否为 admin 路由.
     *
     * @param  string  $path
     * @return bool
     */
    public function isAdminRoute(string $path)
    {
        return Str::startsWith($path, config('layadmin.routes.web.prefix'));
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
        if (! $this->isAdminRoute($path)) {
            return [];
        }

        $configs = array_column($this->cacheConfig(),null,'uri');

        if (!Arr::has($configs,$path)) {
            $pageConfigPath = resource_path('config/'.$path.'.json');
            throw new InvalidPageConfigException("页面配置错误：配置文件[$pageConfigPath]不存在");
        }

        return Arr::get($configs,$path);
    }

    /**
     * 初始化视图依赖的数据.
     *
     * @return array
     *
     * @throws InvalidPageConfigException
     */
    public function bootstrap()
    {
        // todo 配置校验；table\form 处理
        return [
            'version' => $this->version(),
            'params' => request()->all() ?: (object) [],
            'page' => $this->getPageConfig(request()->path()),
        ];
    }

    /**
     * 缓存页面配置项
     *
     * @return mixed
     * @throws InvalidPageConfigException
     */
    protected function cacheConfig()
    {
        try {
            return $this->cache->remember(config('layadmin.cache.key'),config('layadmin.cache.expiration_time'),function () {
                return collect(File::allFiles(resource_path('config')))->map(function ($item) {
                    try {
                        $content = json_decode($item->getContents(), true, 512, JSON_THROW_ON_ERROR);
                    } catch (Throwable $e) {
                        throw new InvalidPageConfigException("[{$item->getRelativePathname()}]解析错误：{$e->getMessage()}");
                    }

                    if (!Arr::has($content,'uri')) {
                        throw new InvalidPageConfigException("[{$item->getRelativePathname()}]缺少 uri 配置项");
                    }

                    Arr::set($content,'uri',Str::start($content['uri'],config('layadmin.routes.web.prefix').'/'));

                    return array_merge([
                        'id' => Str::replace(DIRECTORY_SEPARATOR, '-', $content['uri']),
                        'title' => Arr::get($content, 'title', config('layadmin.title')),
                        'styles' => [],
                        'scripts' => [],
                        'components' => [],
                    ], $content);
                })->all();
            });
        } catch (\Throwable $e) {
            throw new InvalidPageConfigException('页面配置错误：'.$e->getMessage());
        }
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
     * 获取缓存驱动
     *
     * @param CacheManager $cacheManager
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
