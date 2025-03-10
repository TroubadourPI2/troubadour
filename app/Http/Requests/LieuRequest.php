<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

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
        if ($this->route()->getName() === 'usagerLieux.changerEtatLieu') {
            return [
                'actif' => 'required|boolean',
            ];
        }

        $rules = [
            'rue' => 'required|regex:/^[a-zA-Z0-9\'\,\-_À-ÿ ]+$/|max:64',
            'noCivic' => 'required|numeric|max:99999',
            'codePostal' => 'required|regex:/^[A-Z][0-9][A-Z] ?[0-9][A-Z][0-9]$/i|max:7',
            'nomEtablissement' => 'required',
            'photoLieu' => 'nullable|mimes:png,jpg|max:2048',
            'siteWeb' => 'nullable|url:https|max:64',
            'numeroTelephone' => 'required|regex:/^\d{3}-\d{3}-\d{4}$/',
            'description' => 'nullable|string|max:500',
            'selectQuartierLieu' => 'required|exists:Quartiers,id',
            'selectTypeLieu' => 'required|exists:TypeLieux,id',
        ];

        return $rules;
    }

    /**
     * Définit les messages d'erreur personnalisés.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'rue.required' => __('validations.rueRequise'),
            'rue.regex' => __('validations.rueFormatInvalide'),
            'rue.max' => __('validations.rueMax'),

            'noCivic.required' => __('validations.noCivicRequis'),
            'noCivic.numeric' => __('validations.noCivicNumerique'),
            'noCivic.max' => __('validations.noCivicMax'),

            'codePostal.required' => __('validations.codePostalRequis'),
            'codePostal.regex' => __('validations.codePostalFormat'),
            'codePostal.max' => __('validations.codePostalMax'),

            'nomEtablissement.required' => __('validations.nomEtablissementRequis'),

            'photoLieu.required' => __('validations.photoLieuRequise'),
            'photoLieu.image' => __('validations.photoLieuImage'),
            'photoLieu.mimes' => __('validations.photoLieuFormat'),
            'photoLieu.max' => __('validations.photoLieuMax'),

            'siteWeb.url' => __('validations.siteWebInvalide'),
            'siteWeb.max' => __('validations.siteWebMax'),

            'numeroTelephone.required' => __('validations.telephoneRequis'),
            'numeroTelephone.regex' => __('validations.telephoneFormat'),

            'description.max' => __('validations.descriptionMax'),

            'selectQuartierLieu.required' => __('validations.quartierRequis'),
            'selectQuartierLieu.exists' => __('validations.quartierExiste'),

            'selectTypeLieu.required' => __('validations.typeLieuRequis'),
            'selectTypeLieu.exists' => __('validations.typeLieuExiste'),

            'actif.boolean' => __('validations.actifBoolean'),
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
        } elseif ($nomRouteActuelle === 'usagerLieux.modifierLieu') {
            session()->put('erreurModifierLieu', $validator->errors());

            throw new HttpResponseException(
                redirect()->back()
                    ->withInput()
            );
        }

        parent::failedValidation($validator);
    }
}
