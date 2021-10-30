<?php

namespace Jiannei\LayAdmin\View\Composers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PageComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $pageUid = $this->getPageUid();
        $pageConf = Arr::get(config('layadmin'), Route::currentRouteName());

        $page = array_merge(['uid' => $pageUid], $pageConf);

        $view->with(compact('page'));
    }

    protected function getPageUid()
    {
        // todo 路由必须命名，且需要遵循规范；抛出异常
        return 'LAY-'.Str::replace('.', '-', Route::currentRouteName());
    }

    protected function getPageConf()
    {
        return Arr::get(config('layadmin'), 'page.'.Route::currentRouteName(), []);
    }
}