<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class LanguesController extends Controller
{
    public function __invoke($locale)
    {
        if (! in_array($locale, ['en', 'fr', 'fr-ca'])) {
            abort(400);  
        }

        Session::put('locale', $locale);

        App::setLocale($locale);

        return redirect()->back();
    }
}
