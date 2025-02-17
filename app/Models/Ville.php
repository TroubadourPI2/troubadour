<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;
    // protected $table = 'Ville';
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
        return $this->hasMany(Quartier::class);
    }

    public function region()
    {
        return $this->belongsTo(RegionAdministrative::class, 'regionId');
    }

    public function province()
    {
        return $this->region?->province ?? null;
    }
}
