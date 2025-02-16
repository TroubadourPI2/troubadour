<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lieu extends Model
{
    use HasFactory;
    protected $table = 'Lieux';
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

    public function ville()
    {
        return $this->quartier->ville ?? null;
    }

    public function region()
    {
        return $this->ville()?->region ?? null;
    }

    public function province()
    {
        return $this->region()?->province ?? null;
    }

    public function pays()
    {
        return $this->ville()?->pays ?? null;
    }

    public function typeLieu()
    {
        return $this->belongsTo(TypeLieu::class, 'typeLieuId');
    }
}
