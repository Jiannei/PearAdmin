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
                // http://www.pearadmin.com/doc/index.html
                'logo' => [
                    'title' => 'Lay Admin', // 网站名称
                    'image' => '/admin/images/logo.png', // 网站图标
                ],
                'menu' => [
                    'collaspe' => true, // 侧边的默认状态
                    // 菜单数据
                    'data' => [
                        [
                            'id' => 1,
                            'title' => '工作空间',
                            'icon' => 'layui-icon layui-icon-console',
                            'type' => 0,
                            'href' => '',
                            'children' => [
                                [
                                    'id' => 10,
                                    'title' => '控制后台',
                                    'icon' => 'layui-icon layui-icon-console',
                                    'type' => 1,
                                    'openType' => '_iframe',
                                    'href' => 'admin/view/console/console1.html',
                                ],
                                [
                                    'id' => 13,
                                    'title' => '数据分析',
                                    'icon' => 'layui-icon layui-icon-console',
                                    'type' => 1,
                                    'openType' => '_iframe',
                                    'href' => 'admin/view/console/console2.html',
                                ],
                                [
                                    'id' => 14,
                                    'title' => '百度一下',
                                    'icon' => 'layui-icon layui-icon-console',
                                    'type' => 1,
                                    'openType' => '_iframe',
                                    'href' => 'http=>//www.bing.com',
                                ],
                                [
                                    'id' => 15,
                                    'title' => '主题预览',
                                    'icon' => 'layui-icon layui-icon-console',
                                    'type' => 1,
                                    'openType' => '_iframe',
                                    'href' => 'admin/view/system/theme.html',
                                ],
                                [
                                    'id' => 16,
                                    'title' => '酸爽翻倍',
                                    'icon' => 'layui-icon layui-icon-console',
                                    'type' => 1,
                                    'openType' => '_iframe',
                                    'href' => 'admin/view/document/core.html',
                                ],
                            ],
                        ],
                        [
                            'id' => 'component',
                            'title' => '常用组件',
                            'icon' => 'layui-icon layui-icon-component',
                            'type' => 0,
                            'href' => '',
                            'children' => [
                                [
                                    'id' => 201,
                                    'title' => '基础组件',
                                    'icon' => 'layui-icon layui-icon-console',
                                    'type' => 0,
                                    'children' => [
                                        [
                                            'id' => 2011,
                                            'title' => '功能按钮',
                                            'icon' => 'layui-icon layui-icon-face-smile',
                                            'type' => 1,
                                            'openType' => '_iframe',
                                            'href' => 'admin/view/document/button.html',
                                        ],
                                        [
                                            'id' => 2014,
                                            'title' => '表单集合',
                                            'icon' => 'layui-icon layui-icon-face-cry',
                                            'type' => 1,
                                            'openType' => '_iframe',
                                            'href' => 'admin/view/document/form.html',
                                        ],
                                        [
                                            'id' => 2010,
                                            'title' => '字体图标',
                                            'icon' => 'layui-icon layui-icon-face-cry',
                                            'type' => 1,
                                            'openType' => '_iframe',
                                            'href' => 'admin/view/document/icon.html',
                                        ],
                                        [
                                            'id' => 2012,
                                            'title' => '多选下拉',
                                            'icon' => 'layui-icon layui-icon-face-cry',
                                            'type' => 1,
                                            'openType' => '_iframe',
                                            'href' => 'admin/view/document/select.html',
                                        ],
                                        [
                                            'id' => 2013,
                                            'title' => '动态标签',
                                            'icon' => 'layui-icon layui-icon-face-cry',
                                            'type' => 1,
                                            'openType' => '_iframe',
                                            'href' => 'admin/view/document/tag.html',
                                        ],
                                    ],
                                ],
                                [
                                    'id' => 203,
                                    'title' => '进阶组件',
                                    'icon' => 'layui-icon layui-icon-console',
                                    'type' => 0,
                                    'children' => [
                                        [
                                            'id' => 2031,
                                            'title' => '数据表格',
                                            'icon' => 'layui-icon layui-icon-face-cry',
                                            'type' => 1,
                                            'openType' => '_iframe',
                                            'href' => 'admin/view/document/table.html',
                                        ],
                                        [
                                            'id' => 2032,
                                            'title' => '分布表单',
                                            'icon' => 'layui-icon layui-icon-face-cry',
                                            'type' => 1,
                                            'openType' => '_iframe',
                                            'href' => 'admin/view/document/step.html',
                                        ],
                                        [
                                            'id' => 2033,
                                            'title' => '树形表格',
                                            'icon' => 'layui-icon layui-icon-face-cry',
                                            'type' => 1,
                                            'openType' => '_iframe',
                                            'href' => 'admin/view/document/treetable.html',
                                        ],
                                        [
                                            'id' => 2034,
                                            'title' => '树状结构',
                                            'icon' => 'layui-icon layui-icon-face-cry',
                                            'type' => 1,
                                            'openType' => '_iframe',
                                            'href' => 'admin/view/document/dtree.html',
                                        ],
                                        [
                                            'id' => 2035,
                                            'title' => '文本编辑',
                                            'icon' => 'layui-icon layui-icon-face-cry',
                                            'type' => 1,
                                            'openType' => '_iframe',
                                            'href' => 'admin/view/document/tinymce.html',
                                        ],
                                        [
                                            'id' => 2036,
                                            'title' => '卡片组件',
                                            'icon' => 'layui-icon layui-icon-face-cry',
                                            'type' => 1,
                                            'openType' => '_iframe',
                                            'href' => 'admin/view/document/card.html',
                                        ],
                                    ],
                                ],
                                [
                                    'id' => 202,
                                    'title' => '弹层组件',
                                    'icon' => 'layui-icon layui-icon-console',
                                    'type' => 0,
                                    'children' => [
                                        [
                                            'id' => 2021,
                                            'title' => '抽屉组件',
                                            'icon' => 'layui-icon layui-icon-face-cry',
                                            'type' => 1,
                                            'openType' => '_iframe',
                                            'href' => 'admin/view/document/drawer.html',
                                        ],
                                        [
                                            'id' => 2022,
                                            'title' => '消息通知 (过时)',
                                            'icon' => 'layui-icon layui-icon-face-cry',
                                            'type' => 1,
                                            'openType' => '_iframe',
                                            'href' => 'admin/view/document/notice.html',
                                        ],
                                        [
                                            'id' => 2025,
                                            'title' => '消息通知 (新增)',
                                            'icon' => 'layui-icon layui-icon-face-cry',
                                            'type' => 1,
                                            'openType' => '_iframe',
                                            'href' => 'admin/view/document/toast.html',
                                        ],
                                        [
                                            'id' => 2024,
                                            'title' => '加载组件',
                                            'icon' => 'layui-icon layui-icon-face-cry',
                                            'type' => 1,
                                            'openType' => '_iframe',
                                            'href' => 'admin/view/document/loading.html',
                                        ],
                                        [
                                            'id' => 2023,
                                            'title' => '弹层组件',
                                            'icon' => 'layui-icon layui-icon-face-cry',
                                            'type' => 1,
                                            'openType' => '_iframe',
                                            'href' => 'admin/view/document/popup.html',
                                        ],
                                    ],
                                ],
                                [
                                    'id' => 60331,
                                    'title' => '高级组件',
                                    'icon' => 'layui-icon layui-icon-console',
                                    'type' => 0,
                                    'children' => [
                                        [
                                            'id' => 60131,
                                            'title' => '多选项卡',
                                            'icon' => 'layui-icon layui-icon-face-cry',
                                            'type' => 1,
                                            'openType' => '_iframe',
                                            'href' => 'admin/view/document/tab.html',
                                        ],
                                        [
                                            'id' => 60132,
                                            'title' => '数据菜单',
                                            'icon' => 'layui-icon layui-icon-face-cry',
                                            'type' => 1,
                                            'openType' => '_iframe',
                                            'href' => 'admin/view/document/menu.html',
                                        ],
                                    ],
                                ],
                                [
                                    'id' => 204,
                                    'title' => '其他组件',
                                    'icon' => 'layui-icon layui-icon-console',
                                    'type' => 0,
                                    'children' => [
                                        [
                                            'id' => 2041,
                                            'title' => '哈希加密',
                                            'icon' => 'layui-icon layui-icon-face-cry',
                                            'type' => 1,
                                            'openType' => '_iframe',
                                            'href' => 'admin/view/document/hash.html',
                                        ],
                                        [
                                            'id' => 2042,
                                            'title' => '图标选择',
                                            'icon' => 'layui-icon layui-icon-face-cry',
                                            'type' => 1,
                                            'openType' => '_iframe',
                                            'href' => 'admin/view/document/iconPicker.html',
                                        ],
                                        [
                                            'id' => 2043,
                                            'title' => '省市级联',
                                            'icon' => 'layui-icon layui-icon-face-cry',
                                            'type' => 1,
                                            'openType' => '_iframe',
                                            'href' => 'admin/view/document/area.html',
                                        ],
                                        [
                                            'id' => 2044,
                                            'title' => '数字滚动',
                                            'icon' => 'layui-icon layui-icon-face-cry',
                                            'type' => 1,
                                            'openType' => '_iframe',
                                            'href' => 'admin/view/document/count.html',
                                        ],
                                        [
                                            'id' => 2045,
                                            'title' => '顶部返回',
                                            'icon' => 'layui-icon layui-icon-face-cry',
                                            'type' => 1,
                                            'openType' => '_iframe',
                                            'href' => 'admin/view/document/topBar.html',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'id' => 'result',
                            'title' => '结果页面',
                            'icon' => 'layui-icon layui-icon-auz',
                            'type' => 0,
                            'href' => '',
                            'children' => [
                                [
                                    'id' => 'success',
                                    'title' => '成功',
                                    'icon' => 'layui-icon layui-icon-face-smile',
                                    'type' => 1,
                                    'openType' => '_iframe',
                                    'href' => 'admin/view/result/success.html',
                                ],
                                [
                                    'id' => 'failure',
                                    'title' => '失败',
                                    'icon' => 'layui-icon layui-icon-face-cry',
                                    'type' => 1,
                                    'openType' => '_iframe',
                                    'href' => 'admin/view/result/error.html',
                                ],
                            ],
                        ],
                        [
                            'id' => 'error',
                            'title' => '错误页面',
                            'icon' => 'layui-icon layui-icon-face-cry',
                            'type' => 0,
                            'href' => '',
                            'children' => [
                                [
                                    'id' => 403,
                                    'title' => '403',
                                    'icon' => 'layui-icon layui-icon-face-smile',
                                    'type' => 1,
                                    'openType' => '_iframe',
                                    'href' => 'admin/view/error/403.html',
                                ],
                                [
                                    'id' => 404,
                                    'title' => '404',
                                    'icon' => 'layui-icon layui-icon-face-cry',
                                    'type' => 1,
                                    'openType' => '_iframe',
                                    'href' => 'admin/view/error/404.html',
                                ],
                                [
                                    'id' => 500,
                                    'title' => '500',
                                    'icon' => 'layui-icon layui-icon-face-cry',
                                    'type' => 1,
                                    'openType' => '_iframe',
                                    'href' => 'admin/view/error/500.html',
                                ],
                            ],
                        ],
                        [
                            'id' => 'system',
                            'title' => '系统管理',
                            'icon' => 'layui-icon layui-icon-set-fill',
                            'type' => 0,
                            'href' => '',
                            'children' => [
                                [
                                    'id' => 601,
                                    'title' => '用户管理',
                                    'icon' => 'layui-icon layui-icon-face-smile',
                                    'type' => 1,
                                    'openType' => '_iframe',
                                    'href' => 'admin/view/system/user.html',
                                ],
                                [
                                    'id' => 602,
                                    'title' => '角色管理',
                                    'icon' => 'layui-icon layui-icon-face-cry',
                                    'type' => 1,
                                    'openType' => '_iframe',
                                    'href' => 'admin/view/system/role.html',
                                ],
                                [
                                    'id' => 603,
                                    'title' => '权限管理',
                                    'icon' => 'layui-icon layui-icon-face-cry',
                                    'type' => 1,
                                    'openType' => '_iframe',
                                    'href' => 'admin/view/system/power.html',
                                ],
                                [
                                    'id' => 604,
                                    'title' => '部门管理',
                                    'icon' => 'layui-icon layui-icon-face-cry',
                                    'type' => 1,
                                    'openType' => '_iframe',
                                    'href' => 'admin/view/system/deptment.html',
                                ],
                                [
                                    'id' => 605,
                                    'title' => '行为日志',
                                    'icon' => 'layui-icon layui-icon-face-cry',
                                    'type' => 1,
                                    'openType' => '_iframe',
                                    'href' => 'admin/view/system/log.html',
                                ],
                                [
                                    'id' => 606,
                                    'title' => '数据字典',
                                    'icon' => 'layui-icon layui-icon-face-cry',
                                    'type' => 1,
                                    'openType' => '_iframe',
                                    'href' => 'admin/view/system/dict.html',
                                ],
                            ],
                        ],
                        [
                            'id' => 'common',
                            'title' => '常用页面',
                            'icon' => 'layui-icon layui-icon-template-1',
                            'type' => 0,
                            'href' => '',
                            'children' => [
                                [
                                    'id' => 701,
                                    'title' => '登录页面',
                                    'icon' => 'layui-icon layui-icon-face-smile',
                                    'type' => 1,
                                    'openType' => '_iframe',
                                    'href' => 'login.html',
                                ],
                                [
                                    'id' => 702,
                                    'title' => '空白页面',
                                    'icon' => 'layui-icon layui-icon-face-smile',
                                    'type' => 1,
                                    'openType' => '_iframe',
                                    'href' => 'admin/view/system/space.html',
                                ],
                            ],
                        ],
                        [
                            'id' => 'echarts',
                            'title' => '数据图表',
                            'icon' => 'layui-icon layui-icon-chart',
                            'type' => 0,
                            'href' => '',
                            'children' => [
                                [
                                    'id' => 12121,
                                    'title' => '折线图',
                                    'icon' => 'layui-icon layui-icon-face-smile',
                                    'type' => 1,
                                    'openType' => '_iframe',
                                    'href' => 'admin/view/echarts/line.html',
                                ],
                                [
                                    'id' => 121212,
                                    'title' => '柱状图',
                                    'icon' => 'layui-icon layui-icon-face-smile',
                                    'type' => 1,
                                    'openType' => '_iframe',
                                    'href' => 'admin/view/echarts/column.html',
                                ],
                            ],
                        ],
                        [
                            'id' => 'code',
                            'title' => '开发工具',
                            'icon' => 'layui-icon layui-icon-util',
                            'type' => 0,
                            'href' => '',
                            'children' => [
                                [
                                    'id' => 801,
                                    'title' => '表单构建',
                                    'icon' => 'layui-icon layui-icon-util',
                                    'type' => 1,
                                    'openType' => '_iframe',
                                    'href' => 'view/code',
                                ],
                            ],
                        ],
                    ],
                    'method' => 'GET', // 请求方式 GET / POST
                    'accordion' => true, // 是否开启菜单手风琴
                    'control' => false, // 菜单模式 false 为常规菜单，true 为多系统菜单
                    'controlWidth' => 500, // 顶部菜单的宽度，单位 Px
                    'select' => '0', // 默认选中菜单项 (ID)
                    'async' => false, // 渲染模式，true 为异步接口的方式, false 为静态数据
                ],
                'tab' => [
                    'enable' => true, // 是否开启多标签页
                    'keepState' => true, // 选项卡切换时，是否刷新页面
                    'max' => 30, // 最大打开标签页数量
                    'session' => false, // 存储记忆，刷新浏览器时是否保持打开 Tab
                    'index' => [//  主页初始化数据
                        'id' => '0',
                        'href' => '/admin/view/console/console1.html',
                        'title' => '主页',
                    ],
                ],
                'theme' => [
                    'defaultColor' => '1', // 默认主题色
                    'defaultHeader' => 'light-theme', //
                    'defaultMenu' => 'dark-theme', // 默认菜单主题 (dark-theme / light-theme)
                    'allowCustom' => true, // 是否允许自定义主题，为 false 时，强制使用配置主题
                    'banner' => false, // 通栏布局
                ],
                'colors' => [
                    [
                        'id' => '1',
                        'color' => '#2d8cf0',
                    ],
                    [
                        'id' => '2',
                        'color' => '#5FB878',
                    ],
                    [
                        'id' => '3',
                        'color' => '#1E9FFF',
                    ],
                    [
                        'id' => '4',
                        'color' => '#FFB800',
                    ],
                    [
                        'id' => '5',
                        'color' => 'darkgray',
                    ],
                ],
                'links' => [
                    [
                        'icon' => 'layui-icon layui-icon-auz',
                        'title' => '官方网站',
                        'href' => 'http=>//www.pearadmin.com',
                    ],
                    [
                        'icon' => 'layui-icon layui-icon-auz',
                        'title' => '开发文档',
                        'href' => 'http=>//www.pearadmin.com',
                    ],
                    [
                        'icon' => 'layui-icon layui-icon-auz',
                        'title' => '开源地址',
                        'href' => 'https=>//gitee.com/Jmysy/Pear-Admin-Layui',
                    ],
                ],
                'other' => [
                    'keepLoad' => 1200, // 主页动画加载时长
                    'autoHead' => true, // 顶部颜色跟随主题
                ],
                'header' => [
                    'message' => '/admin/data/message.json',
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
