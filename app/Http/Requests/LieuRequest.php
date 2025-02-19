<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LieuRequest extends FormRequest
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
            // 'rue' => 'required|regex:/^[a-zA-Z0-9\'\,\-_À-ÿ ]+$/|max:64',
            // 'noCivic' => 'required|alpha_num',
            // 'codePostal' => 'required|regex:/^[A-Za-z0-9 \-]{3,10}$/i',
            // 'codePostal' => 'required|regex:/^[A-Z][0-9][A-Z] ?[0-9][A-Z][0-9]$/i|max:7', // A1A 1A1
            'nomEtablissement' => 'required',
            // 'photoLieu' => 'required|image|mimes:png,jpg|max:2048',
            // 'siteWeb' => 'nullable|regex:/^(www\.)?([a-zA-Z0-9.-]+)(\.[a-zA-Z]{2,})(\/[^\s]*)?$/|max:64',
            // 'numeroTelephone'  => 'required|alpha_num',
            // 'actif' => 'nullable',
            // 'description' => 'required|max:500',
            // 'selectQuartierLieu' => 'required',
            // 'selectTypeLieu' => 'required',
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
