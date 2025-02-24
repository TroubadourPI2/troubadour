<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ActiviteRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Définit les règles de validation applicables à la requête.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom'              => 'required|string|max:64',
            'dateDebut'        => 'required|date|after_or_equal:today',
            'dateFin'          => 'nullable|date|after_or_equal:dateDebut',
            'actif'            => 'boolean',
            'description'      => 'nullable|string|max:500',
            'typeActivite_id'  => 'required|exists:TypeActivites,id',
            'lieu_id'          => 'required|exists:Lieux,id',
            'photos'           => 'nullable|array',    
            'photos.*'         => 'nullable|mimes:png,jpg|max:2048',      
        ];
    }
    
    /**
     * Personnalise les messages d'erreur de validation.
     */
    public function messages(): array
    {
        return [
            'nom.required'              => 'Le champ nom est obligatoire.',
            'nom.max'                   => 'Le champ nom ne doit pas dépasser 64 caractères.',
            'dateDebut.required'        => 'La date de début est obligatoire.',
            'dateDebut.date'            => 'La date de début doit être une date valide.',
            'dateDebut.after_or_equal'  => 'La date de début ne doit pas être antérieure à aujourd\'hui.',
            'dateFin.date'              => 'La date de fin doit être une date valide.',
            'dateFin.after_or_equal'    => 'La date de fin ne doit jamais être avant la date de début.',
            'actif.boolean'             => 'Le champ actif doit être vrai ou faux.',
            'description.max'           => 'La description ne doit pas dépasser 500 caractères.',
            'typeActivite_id.required'  => 'Le type d\'activité est obligatoire.',
            'typeActivite_id.exists'    => 'Le type d\'activité sélectionné est invalide.',
            'lieu_id.required'          => 'Le lieu est obligatoire.',
            'lieu_id.exists'            => 'Le lieu sélectionné est invalide.',
            'photos.*.mimes'            => 'Chaque photo doit être au format PNG ou JPG.',
            'photos.*.max'              => 'Chaque photo ne doit pas dépasser 2048 kilo-octets.',
        ];
    }
}
