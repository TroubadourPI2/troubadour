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
        // Récupérer le nom de la route actuelle
        $nomRouteActuelle = $this->route()->getName();
    
        // Si c'est la route d'admin pour modifier un usager, on valide uniquement role_id et statut_id
        if ($nomRouteActuelle === 'admin.ModifierUsagers') {
            return [
                'role_id' => 'required|exists:RoleUsagers,id',
                'statut_id' => 'required|exists:Statuts,id',
            ];
        }
    
        // Sinon, appliquer les règles standards
        $rules = [
            'prenom' => 'required|regex:/^[A-Za-zÀ-ÿ\'\-]+(?: [A-Za-zÀ-ÿ\'\-]+)*$/|max:32',
            'nom' => 'required|regex:/^[A-Za-zÀ-ÿ\'\-]+(?: [A-Za-zÀ-ÿ\'\-]+)*$/|max:32',
            'password_confirmation' => 'required|same:password',
            'role_id' => 'required|exists:RoleUsagers,id',
        ];
    
        if ($nomRouteActuelle === 'usagers.modifier') {
            $usagerId = $this->route('usager');
            $rules['password'] = 'sometimes|required_with:password_confirmation|nullable|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W).{8,}$/|min:8|confirmed';
            $rules['courriel'] = 'required|email|max:64|unique:usagers,courriel,'. $usagerId .'';
        } else {
            $rules['password'] = 'required|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W).{8,}$/|min:8|confirmed';
            $rules['courriel'] = 'required|email|max:64|unique:usagers,courriel';
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
            'courriel.unique' => __('validations.courrielUnique'),
            'courriel.max' => __('validations.courrielMax'),

            'password.required' => __('validations.passwordRequis'),
            'password.regex' => __('validations.passwordRegex'),
            'password.min' => __('validations.passwordMin'),
            'password.confirmed' => __('validations.passwordConfirme'),
            'password.required_with' => __('validations.passwordRequisAvec'),

            'role_id.required' => __('validations.roleRequis'),
            'role_id.exists' => __('validations.roleInvalide'),

            'statut_id.required' => __('validations.statutRequis'),
            'statut_id.exists' => __('validations.statutInvalide'),
        ];
     
    }
    protected function failedValidation(Validator $validator)
    {
        $nomRouteActuelle = $this->route()->getName();
    
        if ($nomRouteActuelle === 'admin.ModifierUsagers') {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $validator->errors()
            ], 422));
        }
    
        if ($nomRouteActuelle === 'usagers.modifier') {
            session()->put('erreurModifierUsager', $validator->errors());
    
            throw new HttpResponseException(
                redirect()->back()->withInput()
            );
        }

        if($nomRouteActuelle === 'usagers.CreationUsager'){
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $validator->errors()
            ], 422));
        }
    
        parent::failedValidation($validator);
    }
    
}
