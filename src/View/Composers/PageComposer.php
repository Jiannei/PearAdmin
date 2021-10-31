<?php

namespace Jiannei\LayAdmin\View\Composers;

use Illuminate\Support\Arr;
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
        $pageUid = $this->getPageUid($view);
        $pageConf = $this->getPageConf($view);

        $page = array_merge(['uid' => $pageUid], $pageConf);

        $view->with(compact('page'));
    }

    protected function getPageUid(View $view)
    {
        return 'LAY-'.Str::replace('.', '-', $view->getPath());
    }

    protected function getPageConf(View $view)
    {
        return Arr::get(config('layadmin'), 'page.'.$view->getPath(), []);
    }
}