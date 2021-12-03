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
use Jiannei\LayAdmin\Http\Controllers\AdminController;

Route::get('/login', [AdminController::class, 'login']);

Route::get('/errors/404', [AdminController::class, 'errors404']);
Route::get('/errors/500', [AdminController::class, 'errors500']);

Route::get('/{path}', [AdminController::class, 'page'])->where('path', '.+');
