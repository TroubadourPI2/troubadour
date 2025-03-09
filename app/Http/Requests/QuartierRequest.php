<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuartierRequest extends FormRequest
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
        if ($this->route()->getName() === 'ajouter.quartier') {
            return [
                'ville_id' => 'required|integer|exists:villes,id',
                'actif' => 'required|integer',
                'nom' => 'required|string',
            ];
        }

        if ($this->route()->getName() === 'supprimer.quartier') {
            return [
                'id' => 'required|integer|exists:quartier,id',
            ];
        }
    

        $rules = [

        ];

        return $rules;
    }
}
