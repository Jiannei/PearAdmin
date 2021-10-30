<?php

namespace Jiannei\LayAdmin\View\Composers;

use Illuminate\Support\Str;
use Illuminate\View\View;

class PageComposer
{
    public const HOME_VIEW = 'home';// todo config
    public const PAGE_PATH_PREFIX = 'page';
    public const SEPARATOR = '-';

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $pageUid = $this->getPageUniqueId();

        $page = [
            'uid' => $pageUid,
        ];

        $view->with(compact('page'));
    }

    protected function getPageUid()
    {
        $path = Str::replace('.', self::SEPARATOR, implode(self::SEPARATOR, optional(request())->segments()));

        return ltrim(Str::replaceFirst(self::PAGE_PATH_PREFIX, '', $path), self::SEPARATOR) ?: self::HOME_VIEW;
    }
}