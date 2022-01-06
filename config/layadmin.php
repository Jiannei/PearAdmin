<?php

/*
 * This file is part of the jiannei/layadmin.
 *
 * (c) jiannei <longjian.huang@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

return [
    'title' => env('ADMIN_TITLE', 'LayAdmin'),
    'desc' => env('ADMIN_DESC', '江 城 最 具 影 响 力 的 后 台 系 统 之 一'),

    'routes' => [
        'web' => [
            'prefix' => env('ADMIN_WEB_PREFIX', 'admin'),
            'middleware' => ['web', 'admin'],
        ],
        'api' => [
            'prefix' => env('ADMIN_API_PREFIX', 'api'),

            'middleware' => ['web'],
        ],
    ],

    'https' => env('ADMIN_HTTPS', false),

    // layui 组件全局配置
    'table' => [
        'parseData' => '(function(res){return {code:res.code,msg:res.message,count:res.data.meta.pagination.total,data:res.data.list}})',
        'response' => [
            'statusName' => 'code',
            'statusCode' => 200,
        ],
        'defaultToolbar' => [
            ['layEvent' => 'refresh', 'icon' => 'layui-icon-refresh'],
            'filter',
            'print',
            'exports',
        ],
        'page' => true,
        'skin' => 'line',
        'even' => true,
    ],

    'select' => [
        'response' => [
            'statusCode' => 200,
            'statusName' => 'code',
            'msgName' => 'message',
            'dataName' => 'data',
        ],
    ],
];
