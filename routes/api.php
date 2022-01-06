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

// 无需授权的接口

// 需授权的接口
Route::middleware('auth:'.config('layadmin.guard'))->group(function () {
});
