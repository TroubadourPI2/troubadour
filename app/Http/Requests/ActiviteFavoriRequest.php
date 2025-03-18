<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActiviteFavoriRequest extends FormRequest
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

        if ($this->route()->getName() === 'delete.favoris.activite') {
            return [
                'id' => 'required|integer|exists:ActiviteFavoris,id',
            ];
        }
    

        $rules = [
            'idActivite' => 'required|integer|exists:Activites,id',
            'idUsager' => 'required|integer|exists:Usagers,id',
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'id.exists'             => __('validations.FavoriIdExiste'),
            'idActivite.exists'         => __('validations.FavoriActiviteIdExiste'), #----- important de l'ajouter dans le fichier de langue
            'idUsager.exists'       => __('validations.FavoriUsagerIdExiste'),
        ];
    }
}
