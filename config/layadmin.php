<?php

return [
    'title' => env('APP_NAME', 'LayAdmin'),

    'page' => [
        'index' => [
            'title' => '首页',
            'styles' => [
                'layadmin/css/loader.css',
                'layadmin/css/admin.css',
            ],
            'scripts' => [
                'admin/js/index.js',
            ],
        ],
    ],
];