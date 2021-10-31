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
            'config' => [
                "logo" => [
                    "title" => "Lay Admin",
                    "image" => "/admin/images/logo.png",
                ],
                "menu" => [
                    "data" => "/admin/config/menu.json",
                    "collaspe" => true,
                    "accordion" => true,
                    "method" => "GET",
                    "control" => false,
                    "select" => "0",
                ],
                "tab" => [
                    "enable" => true,
                    "keepState" => true,
                    "tabMax" => 30,
                    "index" => [
                        "id" => "0",
                        "href" => "/admin/view/console/console1.html",
                        "title" => "首页",
                    ],
                ],
                "theme" => [
                    "defaultColor" => "2",
                    "defaultMenu" => "dark-theme",
                    "allowCustom" => true,
                ],
                "colors" => [
                    [
                        "id" => "1",
                        "color" => "#2d8cf0",
                    ],
                    [
                        "id" => "2",
                        "color" => "#5FB878",
                    ],
                    [
                        "id" => "3",
                        "color" => "#1E9FFF",
                    ],
                    [
                        "id" => "4",
                        "color" => "#FFB800",
                    ],
                    [
                        "id" => "5",
                        "color" => "darkgray",
                    ],
                ],
                "links" => [
                    [
                        "icon" => "layui-icon layui-icon-auz",
                        "title" => "官方网站",
                        "href" => "http=>//www.pearadmin.com",
                    ],
                    [
                        "icon" => "layui-icon layui-icon-auz",
                        "title" => "开发文档",
                        "href" => "http=>//www.pearadmin.com",
                    ],
                    [
                        "icon" => "layui-icon layui-icon-auz",
                        "title" => "开源地址",
                        "href" => "https=>//gitee.com/Jmysy/Pear-Admin-Layui",
                    ],
                ],
                "other" => [
                    "keepLoad" => 1200,
                    "autoHead" => false,
                ],
                "header" => [
                    "message" => "/admin/data/message.json",
                ],
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
