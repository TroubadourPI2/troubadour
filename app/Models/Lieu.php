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
        'quartier_id',
        'typeLieu_id',
        'proprietaire_id',
    ];

    // Relation : Un lieu appartient à un quartier.

    public function quartier()
    {
        return $this->belongsTo(Quartier::class);
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
        return $this->belongsTo(TypeLieu::class, 'typeLieu_id');
    }

    public function activites(){
        return $this->belongsToMany(Activite::class);
    }

    public function favoris()
    {
        return $this->hasMany(Favori::class, 'lieu_id');
    }
}
