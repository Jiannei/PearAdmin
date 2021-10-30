<?php

namespace Jiannei\LayAdmin\View\Components\Layouts;

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
        $config = config('layadmin');

        return view('lay:components.layouts.base', compact('config'));
    }
}