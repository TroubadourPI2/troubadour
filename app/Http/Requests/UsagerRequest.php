<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UsagerRequest extends FormRequest
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


            'prenom'=> 'required|regex:/^[A-Za-zÀ-ÿ\'\-]+(?: [A-Za-zÀ-ÿ\'\-]+)*$/|max:32',   
            'nom'=> 'required|regex:/^[A-Za-zÀ-ÿ\'\-]+(?: [A-Za-zÀ-ÿ\'\-]+)*$/|max:32',
            'courriel'=> 'required|email|regex:/^[\w\.-]+@[a-zA-Z0-9\.-]+\.[a-zA-Z]{2,6}$/|max:64',
            'password' => 'required|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W).{8,}$/|min:8',
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
            'prenom.required' => 'Le prénom est requis.',
            'prenom.regex' => 'Le prénom ne peut contenir que des lettres, des apostrophes, des traits d\'union et des espaces.',
            'prenom.max' => 'Le prénom ne peut pas dépasser 32 caractères.',

            'nom.required' => 'Le nom est requis.',
            'nom.regex' => 'Le nom ne peut contenir que des lettres, des apostrophes, des traits d\'union et des espaces.',
            'nom.max' => 'Le nom ne peut pas dépasser 32 caractères.',

            'courriel.required' => 'Le courriel est requis.',
            'courriel.email' => 'L\'adresse courriel n\'est pas valide.', 
            'courriel.regex' => "L'adresse courriel n'est pas dans un format valide.", 

            'password.required' => 'Le mot de passe est requis.',
            'password.regex' => 'Le mot de passe doit contenir au moins 8 caractères, une majuscule, un chiffre et un caractère spécial.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',

            
        ];
     
    }

    // protected function failedValidation(Validator $validator)
    // {
    //     $nomRouteActuelle = $this->route()->getName();

    //     if ($nomRouteActuelle === 'usagerLieux.ajouterLieu') {
    //         session()->put('erreurAjouterLieu', $validator->errors());

    //         throw new HttpResponseException(
    //             redirect()->back()
    //                 ->withInput()
    //         );
    //     }
    //     elseif ($nomRouteActuelle === 'usagerLieux.modifierLieu') {
    //         session()->put('erreurModifierLieu', $validator->errors());

    //         throw new HttpResponseException(
    //             redirect()->back()
    //                 ->withInput()
    //         );
    //     }

    //     parent::failedValidation($validator);
    // }
}
