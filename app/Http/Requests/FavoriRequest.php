<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FavoriRequest extends FormRequest
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

        if ($this->route()->getName() === 'DeleteFavoris') {
            return [
                'id' => 'required|integer|exists:Favoris,id',
            ];
        }
    

        $rules = [
            'idLieu' => 'required|integer|exists:lieux,id',
            'idUsager' => 'required|integer|exists:usagers,id',
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'id.exists'             => __('validations.FavoriIdExiste'),
            'idLieu.exists'         => __('validations.FavoriLieuIdExiste'),
            'idUsager.exists'       => __('validations.FavoriUsagerIdExiste'),
        ];
    }
}
