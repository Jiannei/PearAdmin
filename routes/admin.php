<?php

use Illuminate\Support\Facades\Route;
use Jiannei\LayAdmin\Http\Controllers\AdminController;

Route::get('/login', [AdminController::class, 'login']);

Route::get('/errors/404', [AdminController::class, 'errors404']);
Route::get('/errors/500', [AdminController::class, 'errors500']);

Route::get('/{path}', [AdminController::class, 'page'])->where('path', '.+');