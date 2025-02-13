<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lieu extends Model
{
    protected $table = 'Lieu';
    protected $fillable = [
        'rue',
        'noCivic',
        'codePostal',
        'nomEtablissement',
        'photoLieu',
        'siteWeb',
        'numeroTelephone',
        'actif',
        'description',
        'quartierId',
        'typeLieuId',
        'proprietaireId',
    ];


     // Relation : Un lieu appartient à un quartier.
 
    public function quartier()
    {
        return $this->belongsTo(Quartier::class, 'quartierId');
    }
}
