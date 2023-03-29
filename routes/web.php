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

// 无需授权的页面
Route::get('/login', LayAdmin::view())->middleware('guest:'.config('layadmin.guard'))->name('login'); // 登录

// 需授权的页面
Route::middleware('auth:'.config('layadmin.guard'))->group(function () {
    Route::get('/{path}', LayAdmin::view())->where('path', '.+')->name('page'); // 核心路由
});
