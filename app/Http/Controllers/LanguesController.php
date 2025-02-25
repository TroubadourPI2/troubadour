<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class LanguesController extends Controller
{
    public function __invoke($locale)
    {
        // Vérifier que la langue demandée est valide
        if (! in_array($locale, ['en', 'fr', 'fr-ca'])) {
            abort(400);  // Si la langue n'est pas valide, retourner une erreur
        }

        // Stocker la langue dans la session
        Session::put('locale', $locale);

        // Appliquer immédiatement la langue
        App::setLocale($locale);

        // Rediriger vers la page précédente
        return redirect()->back();
    }
}
