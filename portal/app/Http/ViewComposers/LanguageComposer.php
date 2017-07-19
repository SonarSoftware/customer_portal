<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;

class LanguageComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $language = Lang::getLocale();
        $view->with('language', $language);
    }
}