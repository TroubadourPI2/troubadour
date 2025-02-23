<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LieuModifierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'rueModifie' => 'required|regex:/^[a-zA-Z0-9\'\,\-_À-ÿ ]+$/|max:64',
            'noCivicModifie' => 'required|numeric|max:99999',
            'codePostalModifie' => 'required|regex:/^[A-Z][0-9][A-Z] ?[0-9][A-Z][0-9]$/i|max:7', 
            'nomEtablissementModifie' => 'required',
            'photoLieuModifie' => 'nullable|mimes:png,jpg|max:2048',
            'siteWebModifie' => 'nullable|url:https|max:64',
            'numeroTelephoneModifie' => 'required|regex:/^\d{3}-\d{3}-\d{4}$/',
            'actif' => 'nullable',
            'descriptionModifie' => 'nullable|max:500',
            'selectQuartierLieuModifie' => 'required',
            'selectTypeLieuModifie' => 'required',
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
            'rueModifie.required' => 'La rue est requise.',
            'rueModifie.regex'    => 'Le format de la rue est invalide.',
            'rueModifie.max'      => 'La rue ne doit pas dépasser 64 caractères.',

            'noCivicModifie.required'   => 'Le numéro civique est requis.',
            'noCivicModifie.numeric'  => 'Le numéro civique doit contenir uniquement des chiffres.',
            'noCivicModifie.max' => 'Le numéro civique ne peut pas dépasser 99999.',

            'codePostalModifie.required' => 'Le code postal est requis.',
            'codePostalModifie.regex'    => 'Le code postal doit être au format A1A 1A1.',
            'codePostalModifie.max'      => 'Le code postal ne doit pas dépasser 7 caractères.',

            'nomEtablissementModifie.required' => 'Le nom de l\'établissement est requis.',

            'photoLieuModifie.required' => 'La photo du lieu est requise.',
            'photoLieuModifie.image'    => 'Le fichier doit être une image.',
            'photoLieuModifie.mimes'    => 'La photo doit être au format PNG ou JPG.',
            'photoLieuModifie.max'      => 'La taille de la photo ne doit pas dépasser 2 Mo.',

            'siteWebModifie.url' => 'Le format du site web est invalide.',
            'siteWebModifie.max'   => 'Le site web ne doit pas dépasser 64 caractères.',

            'numeroTelephoneModifie.required'  => 'Le numéro de téléphone est requis.',
            'numeroTelephoneModifie.regex' => 'Le format du numéro de téléphone est invalide.',

            'descriptionModifie.max' => 'La description ne doit pas dépasser 500 caractères.',

            'selectQuartierLieuModifie.required' => 'Veuillez sélectionner un quartier.',
            'selectTypeLieuModifie.required'     => 'Veuillez sélectionner un type de lieu.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $nomRouteActuelle = $this->route()->getName();

        if ($nomRouteActuelle === 'usagerLieux.modifierLieu') {
            session()->put('erreurModifierLieu', $validator->errors());

            throw new HttpResponseException(
                redirect()->back()
                    ->withInput()
            );
        }

        parent::failedValidation($validator);
    }
}
