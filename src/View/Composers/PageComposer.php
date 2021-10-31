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
        $pageConf = $this->getPageConf();

        $page = array_merge(['uid' => $pageUid, 'styles' => [], 'scripts' => []], $pageConf);

        $view->with(compact('page'));
    }

    protected function getPageUid()
    {
        return 'LAY-'.Str::replace('.', '-', Route::currentRouteName());
    }

    protected function getPageConf()
    {
        return Arr::get(config('layadmin'), 'page.'.Route::currentRouteName(), []);
    }
}