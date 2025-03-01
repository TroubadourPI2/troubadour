<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class LanguesController extends Controller
{
    public function __invoke($locale)
    {
        $locales = array_keys(config('langue.locales'));
        if (! in_array($locale, $locales)) {
            abort(400, 'Langue non supportée');
        } else {
            Session::put('locale', $locale);
            App::setLocale($locale);
        }
        return redirect()->back();
    }
}
