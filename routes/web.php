<?php

/*
 * This file is part of the jiannei/layadmin.
 *
 * (c) jiannei <longjian.huang@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Illuminate\Support\Facades\Route;
use Jiannei\LayAdmin\Support\Facades\LayAdmin;

Route::get('/login', LayAdmin::view())->middleware('guest:admin'); // 登录

Route::middleware('auth:admin')->group(function () {
    Route::get('/{path}', LayAdmin::view())->where('path', '.+'); // 核心路由
});
