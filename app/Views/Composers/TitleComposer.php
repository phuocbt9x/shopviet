<?php

namespace App\Views\Composers;

use Illuminate\View\View;

class TitleComposer
{
    public function compose(View $view)
    {
        $arrPrefix = explode('/', request()->route()->getPrefix());

        if ($arrPrefix[1] == env('PREFIX_ADMIN', 'admin')) {
            $title = 'Dashboard';
        } else {
            $title = ucfirst($arrPrefix[1]);
        }
        if (count($arrPrefix) == 3) {
            $title = ucfirst($arrPrefix[2]);
        }
        $view->with('title', $title);
    }
}
