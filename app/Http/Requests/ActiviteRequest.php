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
            'nomActivite'       => 'required|string|max:64',
            'dateDebut'         => 'required|date|after_or_equal:today',
            'dateFin'           => 'nullable|date|after_or_equal:dateDebut',
            'descriptionActivite'=> 'nullable|string|max:500',
            'typeActivite_id'   => 'required|exists:TypeActivites,id',
            'lieu_id'            => 'required|array',
            'lieu_id.*'          => 'exists:Lieux,id',
            'photos'            => 'nullable|array',
            'photos.*'          => 'nullable|mimes:png,jpg|max:2048',
            'photos.*.position' => 'required|integer|distinct',
            'photos_a_supprimer'   => 'nullable|array',
            'photos_a_supprimer.*' => 'exists:photos,id',
            'positionsActuelles'      => 'nullable|array',
            'positionsActuelles.*'    => 'required|integer|distinct',

        ];
    }
    
    /**
     * Personnalise les messages d'erreur de validation.
     */
    public function messages(): array
    {
        return [
            'nomActivite.required'             => 'Le champ nom est obligatoire.',
            'nomActivite.max'                  => 'Le champ nom ne doit pas dépasser 64 caractères.',
            'dateDebut.required'               => 'La date de début est obligatoire.',
            'dateDebut.date'                   => 'La date de début doit être une date valide.',
            'dateDebut.after_or_equal'         => 'La date de début ne doit pas être antérieure à aujourd\'hui.',
            'dateFin.date'                     => 'La date de fin doit être une date valide.',
            'dateFin.after_or_equal'           => 'La date de fin ne doit jamais être avant la date de début.',
            'actif.boolean'                    => 'Le champ actif doit être vrai ou faux.',
            'descriptionActivite.max'          => 'La description ne doit pas dépasser 500 caractères.',
            'typeActivite_id.required'         => 'Le type d\'activité est obligatoire.',
            'typeActivite_id.exists'           => 'Le type d\'activité sélectionné est invalide.',
            'lieu_id.required'                 => 'Le(s) lieu(x) est/sont obligatoire(s).',
            'lieu_id.*.exists'                 => 'Le(s) lieu(x) sélectionné(s) est/sont invalide(s).',
            'photos.*.mimes'                   => 'Chaque photo doit être au format PNG ou JPG.',
            'photos.*.max'                     => 'Chaque photo ne doit pas dépasser 2048 kilo-octets.',
            'photos.*.position.required'       => 'La position de chaque photo est obligatoire.',
            'photos.*.position.integer'        => 'La position de chaque photo doit être un nombre entier.',
            'photos.*.position.distinct'       => 'Les positions des photos doivent être uniques.',
            'positionsActuelles.*.integer'       => 'La position de chaque photo existante doit être un nombre entier.',
            'positionsActuelles.*.distinct'      => 'Les positions des photos existantes doivent être uniques.',
            'photos_a_supprimer.*.exists'      => 'Une des photos sélectionnées pour la suppression est invalide.',

        ];
    }
    protected function withValidator($validator)
    {
        if ($this->route()->getName() === 'usagerActivites.modifierActivite') {
            $validator->after(function ($validator) {
              
                $positionsNouvelles = [];
                if ($this->has('positionsNouvelles') && is_array($this->positionsNouvelles)) {
                    foreach ($this->positionsNouvelles as $pos) {
                        $positionsNouvelles[] = (int) $pos;
                    }
                }
           
                $positionsExistantes = [];
                if ($this->has('positionsActuelles') && is_array($this->positionsActuelles)) {
                    foreach ($this->positionsActuelles as $pos) {
                        $positionsExistantes[] = (int) $pos;
                    }
                }
      
                $positionsTotales = array_merge($positionsNouvelles, $positionsExistantes);
                sort($positionsTotales);
                $nb = count($positionsTotales);
                if ($nb > 0) {
                  
                    $attendu = range(1, $nb);
                    if ($positionsTotales !== $attendu) {
                        $validator->errors()->add('positions', 'Les positions doivent être une suite séquentielle sans trou (1, 2, …, ' . $nb . ').');
                    }
                }
            });
        }
    }
    

    protected function failedValidation(Validator $validator)
    {
        $nomRouteActuelle = $this->route()->getName();

        if ($nomRouteActuelle === 'usagerActivites.ajouterActivite') {
            session()->put('erreurAjouterActivite', $validator->errors());

            throw new HttpResponseException(
                redirect()->back()
                    ->withInput()
            );
        }
         elseif ($nomRouteActuelle === 'usagerActivites.modifierActivite') {
             session()->put('erreurModifierActivite', $validator->errors());
             session()->put('idActiviteErreur', $this->route('id'));



                        throw new HttpResponseException(
                        redirect()->back()
                            ->withInput()
                    );
                }

        parent::failedValidation($validator);
    }
}
