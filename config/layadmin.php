<?php

return [
    'title' => env('APP_NAME', 'LayAdmin'),

    'page' => [
        // 视图路径 => 视图配置
        'index' => [// 主体框架入口
            'title' => 'LayAdmin',
            'styles' => [
                'layadmin/css/loader.css',
                'layadmin/css/admin.css',
            ],
            'scripts' => [
                'admin/js/index.js',
            ],
        ],
        'errors' => [
            '403' => [
                'styles' => [
                    'admin/css/error.css',
                ],
            ],
            '404' => [
                'styles' => [
                    'admin/css/error.css',
                ],
            ],
            '500' => [
                'styles' => [
                    'admin/css/error.css',
                ],
            ],
        ],
        'login' => [
            'title' => '后台登录',
            'styles' => [
                'admin/css/login.css',
            ],
            'scripts' => [
                'admin/js/login.js',
            ],
        ],
        'console' => [
            'title' => '首页',
            'styles' => [
                'admin/css/console1.css',
            ],
            'scripts' => [
                'admin/js/console.js',
            ],
        ],
        'code' => [
            'title' => '表单生成器',
            'styles' => [
                'admin/css/code.css',
            ],
            'scripts' => [
                'admin/js/code.js',
            ],
        ],
    ],
];