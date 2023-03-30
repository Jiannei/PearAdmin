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

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Jiannei\LayAdmin\Exceptions\InvalidPageConfigException;
use League\Config\Configuration;
use Nette\Schema\Elements\Structure;
use Nette\Schema\Expect;
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
        $configPath = trim(Str::remove($prefix, $path), '/');

        if (! Str::startsWith($path, $prefix) || ! File::exists(resource_path("config/{$configPath}.json"))) {
            return [];
        }

        try {
            $config = json_decode(File::get(resource_path("config/{$configPath}.json")), true, 512, JSON_THROW_ON_ERROR);
            $config['id'] = Str::replace(DIRECTORY_SEPARATOR, '-', $config['uri']);

            $cfg = new Configuration([
                'layadmin' => $this->getSchema(),
            ]);

            $cfg->merge(['layadmin' => $config]);

            return $cfg->get('layadmin');
        } catch (Throwable $e) {
            throw new InvalidPageConfigException("[{$configPath}]解析错误：{$e->getMessage()}");
        }
    }

    protected function getSchema(): Structure
    {
        return Expect::structure([
            'id' => Expect::string()->required(), // 唯一 id
            'uri' => Expect::string()->required(), // 页面路径
            'layout' => Expect::string()->required(), // 页面布局
            'view' => Expect::string()->required(), // 页面视图
            'title' => Expect::string()->default(config('layadmin.title')), // 页面标题
            'styles' => Expect::array(), // 页面样式
            'scripts' => Expect::array(), // 页面自定义脚本
            'components' => Expect::array(), // 页面组件
        ]);
    }
}
