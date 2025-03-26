<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

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
        $routeName = $this->route()->getName();
     
        // Cas de la modification d'usager par l'admin :
        // seules les données liées au rôle et au statut sont validées.
        if ($routeName === 'admin.ModifierUsagers') {
            return [
                'role_id'   => 'required|exists:RoleUsagers,id',
                'statut_id' => 'required|exists:Statuts,id',
            ];
        }
     
        // Règles communes (prenom, nom, courriel)
        $rules = [
            'prenom'   => 'required|regex:/^[A-Za-zÀ-ÿ\'\-]+(?: [A-Za-zÀ-ÿ\'\-]+)*$/|max:32',
            'nom'      => 'required|regex:/^[A-Za-zÀ-ÿ\'\-]+(?: [A-Za-zÀ-ÿ\'\-]+)*$/|max:32',
            'courriel' => 'required|max:64',
        ];
     
        if ($routeName === 'usagers.modifier') {
            // --- MODIFICATION PAR L'UTILISATEUR ---
            // Exclure l’usager actuel dans la règle d’unicité du courriel
            $usager = $this->route('usager');
            $rules['courriel'] .= '|email:rfc,dns|unique:Usagers,courriel,' . $usager->id;
     
            // Le changement de mot de passe est optionnel
            $rules['password'] = 'sometimes|nullable|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W).{8,}$/|min:8|confirmed';
            $rules['password_confirmation'] = 'sometimes|same:password';
     
            // On interdit à l’utilisateur de modifier son rôle
            $rules['role_id'] = 'prohibited';
     
        } elseif ($routeName === 'usagers.CreationUsager') {
            // --- CRÉATION D'UN NOUVEL USAGER ---
            // On exige un rôle pour la création (par exemple, "Utilisateur" = 2)
            $rules['courriel'] .= '|email:rfc,dns|unique:Usagers,courriel,';
            $rules['role_id']   = 'required|exists:RoleUsagers,id';
     
            // Mot de passe requis pour la création
            $rules['password'] = 'required|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W).{8,}$/|min:8|confirmed';
            $rules['password_confirmation'] = 'required|same:password';
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
                'message' => __('statutOuRoleInvalide'),
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
