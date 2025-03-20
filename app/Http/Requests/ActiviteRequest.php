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
   
        if ($this->route()->getName() === 'usagerActivites.modifierStatutActivite') {
            return [
                'actif' => 'required|boolean',
            ];
        }
    

        $rules = [
            'nomActivite'         => 'required|string|max:64',
            'dateDebut'           => 'required|date|after_or_equal:today',
            'dateFin'             => 'nullable|date|after_or_equal:dateDebut',
            'descriptionActivite' => 'nullable|string|max:500',
            'typeActivite_id'     => 'required|exists:TypeActivites,id',
            'lieu_id'             => 'required|array',
            'lieu_id.*'           => 'exists:Lieux,id',
            'photos'              => 'nullable|array|max:5',
            'photos.*'            => 'nullable|mimes:png,jpg|max:2048',
            'photos.*.position'   => 'required|integer|distinct',
            'photos_a_supprimer'  => 'nullable|array',
            'photos_a_supprimer.*'=> 'exists:photos,id',
            'positionsActuelles'  => 'nullable|array',
            'positionsActuelles.*'=> 'required|integer|distinct',
        ];
    
        return $rules;
    }
    
    
    /**
     * Personnalise les messages d'erreur de validation.
     */
    public function messages(): array
    {
        return [
            'nomActivite.required'             => __('validations.nomActiviteRequise'),
            'nomActivite.max'                  => __('validations.nomActiviteMax'),
            'dateDebut.required'               => __('validations.dateDebutRequise'),
            'dateDebut.date'                   => __('validations.dateDebutDate'),
            'dateDebut.after_or_equal'         => __('validations.dateDebutAfterOrEqual'),
            'dateFin.date'                     => __('validations.dateFinDate'),
            'dateFin.after_or_equal'           => __('validations.dateFinAfterOrEqual'),
            'actif.required'                   => __('validations.actifRequis'),
            'actif.boolean'                    => __('validations.actifBoolean'),
            'descriptionActivite.max'          => __('validations.descriptionActiviteMax'),
            'typeActivite_id.required'         => __('validations.typeActiviteIdRequise'),
            'typeActivite_id.exists'           => __('validations.typeActiviteIdExiste'),
            'lieu_id.required'                 => __('validations.lieuIdRequis'),
            'lieu_id.*.exists'                 => __('validations.lieuIdExiste'),
            'photos.*.mimes'                   => __('validations.photoMime'),
            'photos.max'                       => __('validations.photosMax'),
            'photos.*.max'                     => __('validations.photoMax'),
            'photos.*.position.required'       => __('validations.photoPositionRequise'),
            'photos.*.position.integer'        => __('validations.photoPositionInteger'),
            'photos.*.position.distinct'       => __('validations.photoPositionDistinct'),
            'positionsActuelles.*.integer'     => __('validations.positionsActuellesInteger'),
            'positionsActuelles.*.distinct'    => __('validations.positionsActuellesDistinct'),
            'photos_a_supprimer.*.exists'      => __('validations.photoASupprimerExiste'),
        ];
    }
    protected function withValidator($validator)
    {
        if ($this->route()->getName() === 'usagerActivites.ajouterActivite') {
            $validator->after(function ($validator) {
              
                $positionsNouvelles = $this->input('photos', []);
                $positions = [];
        
                foreach ($positionsNouvelles as $index => $photo) {
                    if (isset($photo['position'])) {
                        $positions[] = (int) $photo['position'];
                    }
                }
        
              
                sort($positions);
                $nb = count($positions);
                if ($nb > 0) {
                    $attendu = range(1, $nb);
                    if ($positions !== $attendu) {
                        $validator->errors()->add('positions', __('validations.positionsSequentielle'));
                    }
                }
            });
    }



    if ($this->route()->getName() === 'usagerActivites.modifierActivite') {
        $validator->after(function ($validator) {
            $positionsNouvelles = $this->input('photos.*.position', []);
            $positionsExistantes = $this->input('positionsActuelles', []);

    
            $positionsNouvelles = array_map('intval', $positionsNouvelles);
            $positionsExistantes = array_map('intval', $positionsExistantes);

      
            $positionsTotales = array_merge($positionsNouvelles, $positionsExistantes);

            sort($positionsTotales);
            $nb = count($positionsTotales);
            if ($nb > 0) {
                $attendu = range(1, $nb);
                if ($positionsTotales !== $attendu) {
                    $validator->errors()->add('positions', __('validations.positionsSequentielle'));
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
