<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    protected $table = 'Villes';
    protected $fillable = [
        'nom',
        'actif',
        'regionId',
        'paysId',
    ];


     // Relation : Une ville appartient à un pays.
  
    public function pays()
    {
        return $this->belongsTo(Pays::class, 'paysId');
    }

  
     // Recuperer les quartiers de la ville
  
    public function quartiers()
    {
        return $this->hasMany(Quartier::class, 'quartierId');
    }
}
