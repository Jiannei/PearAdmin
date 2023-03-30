<?php

namespace Jiannei\LayAdmin\Support;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Jiannei\LayAdmin\Exceptions\InvalidPageConfigException;
use Throwable;

class Config
{
    /**
     * 解析并校验页面配置.
     *
     * @return array
     */
    public function parse(): array
    {
        return collect(File::allFiles(resource_path('config')))->map(function ($item) {
            $key = $item->getRelativePathname();

            try {
                $config = json_decode($item->getContents(), true, 512, JSON_THROW_ON_ERROR);
            } catch (Throwable $e) {
                throw new InvalidPageConfigException("[{$key}]解析错误：{$e->getMessage()}");
            }

            return $this->valid($key, $config);
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
    public function valid(string $key, array $config): array
    {
        // todo 配置校验；table\form 处理
        if (!Arr::has($config, 'uri')) {
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
}