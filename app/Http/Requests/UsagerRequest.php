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
        $rules = [
            'prenom' => 'required|regex:/^[A-Za-zÀ-ÿ\'\-]+(?: [A-Za-zÀ-ÿ\'\-]+)*$/|max:32',
            'nom' => 'required|regex:/^[A-Za-zÀ-ÿ\'\-]+(?: [A-Za-zÀ-ÿ\'\-]+)*$/|max:32',
            'courriel' => 'required|email|regex:/^[\w\.-]+@[a-zA-Z0-9\.-]+\.[a-zA-Z]{2,6}$/|max:64',
        ];
    
        if ($this->isMethod('post')) { 
            $rules['password'] = 'required|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W).{8,}$/|min:8|confirmed';
        } else { 
            $rules['password'] = 'sometimes|required_with:password_confirmation|nullable|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W).{8,}$/|min:8|confirmed';
        } 
    
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
            'prenom.required' => __('validations.prenomRequis'),
            'prenom.regex' => __('validations.prenomRegex'),
            'prenom.max' => __('validations.prenomMax'),

            'nom.required' => __('validations.nomRequis'),
            'nom.regex' => __('validations.nomRegex'),
            'nom.max' => __('validations.nomMax'),

            'courriel.required' => __('validations.courrielRequis'),
            'courriel.email' => __('validations.courrielEmail'),
            'courriel.regex' => __('validations.courrielRegex'),

            'password.required' => __('validations.passwordRequis'),
            'password.regex' => __('validations.passwordRegex'),
            'password.min' => __('validations.passwordMin'),
            'password.confirmed' => __('validations.passwordConfirme'),
            'password.required_with' => __('validations.passwordRequisAvec'),
            
        ];
     
    }

    protected function failedValidation(Validator $validator)
    {
        $nomRouteActuelle = $this->route()->getName();


        // if ($nomRouteActuelle === 'usagerLieux.ajouterLieu') {
        //     session()->put('erreurAjouterLieu', $validator->errors());

        //     throw new HttpResponseException(
        //         redirect()->back()
        //             ->withInput()
        //     );
        // }
        if ($nomRouteActuelle === 'usagers.modifier') {
            session()->put('erreurModifierUsager', $validator->errors());

            throw new HttpResponseException(
                redirect()->back()
                    ->withInput()
            );
        }

        parent::failedValidation($validator);
    }
}
