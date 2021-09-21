<?php

return [
    // 网站配置
    "logo" => [
        "title" => "Pear Admin",// 网站名称
        "image" => "admin/images/logo.png",// 网站图标
    ],

    // 菜单配置
    "menu" => [
        "data" => "config/menu",// 菜单数据来源
        "method" => "GET",// 菜单接口的请求方式 GET / POST
        "accordion" => true,// 是否同时只打开一个菜单目录
        "collaspe" => false,// 侧边默认折叠状态
        "control" => false,// 是否开启多系统菜单模式
        "controlWidth" => false,// 顶部菜单宽度 PX
        "select" => "0",// 默认选中的菜单项
        "async" => true,// 是否开启异步菜单，false 时 data 属性设置为静态数据，true 时为后端接口
    ],

    // 视图内容配置
    "tab" => [
        "enable" => true,// 是否开启多选项卡
        "keepState" => true,// 保持视图状态
        "session" => true,// 开启选项卡记忆
        "max" => 30,// 最大可打开的选项卡数量
        "index" => [// 首页
            "id" => "0",// 标识 ID , 建议与菜单项中的 ID 一致
            "href" => "/console/console1",// 页面地址
            "title" => "首页",// 标题
        ],
    ],

    // 主题配置
    "theme" => [
        "defaultColor" => "1",// 默认主题色，对应 colors 配置中的 ID 标识
        "defaultMenu" => "dark-theme",// 默认的菜单主题 dark-theme 黑 / light-theme 白
        "allowCustom" => true,// 是否允许用户切换主题，false 时关闭自定义主题面板
        "banner" => true,// 通栏配置
    ],

    // 主题色配置列表
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
            "href" => "http://www.pearadmin.com",
        ],
        [
            "icon" => "layui-icon layui-icon-auz",
            "title" => "开发文档",
            "href" => "http://www.pearadmin.com",
        ],
        [
            "icon" => "layui-icon layui-icon-auz",
            "title" => "开源地址",
            "href" => "https://gitee.com/Jmysy/Pear-Admin-Layui",
        ],
    ],

    // 其他配置
    "other" => [
        "keepLoad" => 1200,// 主页动画时长
        "autoHead" => false,// 布局顶部主题
    ],

    // 头部配置
    "header" => [
        "message" => "notifications/top",// 站内消息，通过 false 设置关闭
    ],
];
