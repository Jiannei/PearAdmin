<?php

namespace Jiannei\LayAdmin\View\Composers;

use Illuminate\View\View;
use Jiannei\LayAdmin\Support\Facades\LayAdmin;

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
        $page = array_merge([
            'uid' => LayAdmin::getPageUid(),
            'styles' => [],
            'scripts' => [],
        ], LayAdmin::getPageConf());

        $view->with(compact('page'));
    }
}