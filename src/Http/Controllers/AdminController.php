<?php

namespace Jiannei\LayAdmin\Http\Controllers;


use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;
use Jiannei\LayAdmin\Support\Facades\LayAdmin;

class AdminController extends Controller
{
    public function page($path)
    {
        $prefix = config('layadmin.path.prefix');

        $requestPath = $prefix . '/' . $path;
        $pageConfig = LayAdmin::getPageConfig($requestPath);

        if (!($view = Arr::get($pageConfig, 'view')) || !View::exists($view)) {// 配置错误
            return \view('layadmin::errors.404');
        }

        $layadmin = array_merge(\config('layadmin'), [
            'version' => LayAdmin::version(),
            'request' => request()->all() ?: (object)[],
            'page' => LayAdmin::getPageConfig($requestPath),
        ]);

        config(compact('layadmin'));

        return \view($view);
    }

    public function login()
    {
        if (auth(config('layadmin.guard'))->check()) {
            return redirect(config('layadmin.path.home'));
        }

        return \view('layadmin::login');
    }

    public function errors404()
    {
        return \view('layadmin::errors.404');
    }

    public function errors500()
    {
        return \view('layadmin::errors.500');
    }
}