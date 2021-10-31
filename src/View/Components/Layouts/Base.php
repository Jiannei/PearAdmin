<?php

namespace Jiannei\LayAdmin\View\Components\Layouts;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Base extends Component
{
    private $page;

    public function __construct($page)
    {
        $this->page = $page;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $pageUuid = $this->getPageUuid();
        $pageConf = $this->getPageConf();

        $page = array_merge(['page' => $pageUuid], $pageConf);

        return view('layadmin::components.layouts.base', compact('page'));
    }

    protected function getPageUuid()
    {
        return 'LAY-'.Str::replace('.', '-', $this->page);
    }

    protected function getPageConf()
    {
        return Arr::get(config('layadmin'), 'page.'.$this->page, []);
    }
}