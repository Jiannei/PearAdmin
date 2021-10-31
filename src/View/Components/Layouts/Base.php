<?php

namespace Jiannei\LayAdmin\View\Components\Layouts;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Base extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $pageUuid = $this->getPageUuid();
        $pageConf = $this->getPageConf();

        $page = array_merge(['uuid' => $pageUuid], $pageConf);

        return view('layadmin::components.layouts.base', compact('page'));
    }

    protected function getPageUuid()
    {
        // todo 路由必须命名，且需要遵循规范；抛出异常
        return 'LAY-'.Str::replace('.', '-', Route::currentRouteName());
    }

    protected function getPageConf()
    {
        return Arr::get(config('layadmin'), 'page.'.Route::currentRouteName(), []);
    }
}