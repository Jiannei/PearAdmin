<?php

use Illuminate\Support\Facades\Route;
use Jiannei\LayAdmin\Support\Facades\LayAdmin;

Route::get('/login', LayAdmin::view())->middleware('guest:admin');// 登录

Route::middleware('auth:admin')->group(function () {
    Route::get('/{path}', LayAdmin::view())->where('path', '.+');// 核心路由
});