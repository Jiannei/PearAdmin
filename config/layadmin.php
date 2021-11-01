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
    // 后台配置
    'title' => env('APP_NAME', 'LayAdmin'),

    // 视图页面配置
    'page' => [
        'path_prefix' => 'page', // 视图路由路径前缀，需要与视图配置文件的路径对应

        'home' => 'index',// 后台主页视图名称
        'login' => 'login'// 登录页视图名称
    ],

    // layui 组件配置
    'table' => [
        'parseData' => [
            'code' => 'code',
            'msg' => 'message',
            'count' => 'data.meta.pagination.total',
            'data' => 'data.list',
        ],
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

    ],
];
