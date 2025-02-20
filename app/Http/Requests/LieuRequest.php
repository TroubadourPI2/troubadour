<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LieuRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Définit les règles de validation.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'rue' => 'required|regex:/^[a-zA-Z0-9\'\,\-_À-ÿ ]+$/|max:64',
            'noCivic' => 'required|numeric',
            'codePostal' => 'required|regex:/^[A-Z][0-9][A-Z] ?[0-9][A-Z][0-9]$/i|max:7', 
            'nomEtablissement' => 'required',
            'photoLieu' => 'nullable|mimes:png,jpg|max:2048',
            'siteWeb' => 'nullable|regex:/^(www\.)?([a-zA-Z0-9.-]+)(\.[a-zA-Z]{2,})(\/[^\s]*)?$/|max:64',
            'numeroTelephone'  => 'required|alpha_num',
            'actif' => 'nullable',
            'description' => 'nullable|max:500',
            'selectQuartierLieu' => 'required',
            'selectTypeLieu' => 'required',
        ];
    }

    /**
     * Définit les messages d'erreur personnalisés.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // Rue
            'rue.required' => 'La rue est requise.',
            'rue.regex'    => 'Le format de la rue est invalide.',
            'rue.max'      => 'La rue ne doit pas dépasser 64 caractères.',

            'noCivic.required'   => 'Le numéro civique est requis.',
            'noCivic.numeric'  => 'Le numéro civique doit contenir uniquement des chiffres.',

            'codePostal.required' => 'Le code postal est requis.',
            'codePostal.regex'    => 'Le code postal doit être au format A1A 1A1.',
            'codePostal.max'      => 'Le code postal ne doit pas dépasser 7 caractères.',

            'nomEtablissement.required' => 'Le nom de l\'établissement est requis.',

            'photoLieu.required' => 'La photo du lieu est requise.',
            'photoLieu.image'    => 'Le fichier doit être une image.',
            'photoLieu.mimes'    => 'La photo doit être au format PNG ou JPG.',
            'photoLieu.max'      => 'La taille de la photo ne doit pas dépasser 2 Mo.',

            'siteWeb.regex' => 'Le format du site web est invalide.',
            'siteWeb.max'   => 'Le site web ne doit pas dépasser 64 caractères.',

            'numeroTelephone.required'  => 'Le numéro de téléphone est requis.',
            'numeroTelephone.alpha_num' => 'Le numéro de téléphone doit contenir uniquement des chiffres et des lettres.',

            'description.max' => 'La description ne doit pas dépasser 500 caractères.',

            'selectQuartierLieu.required' => 'Veuillez sélectionner un quartier.',
            'selectTypeLieu.required'     => 'Veuillez sélectionner un type de lieu.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $nomRouteActuelle = $this->route()->getName();

        if ($nomRouteActuelle === 'usagerLieux.ajouterLieu') {
            session()->put('erreurAjouterLieu', $validator->errors());

            throw new HttpResponseException(
                redirect()->back()
                    ->withInput()
            );
        }

        parent::failedValidation($validator);
    }
}
