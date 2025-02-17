<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
    protected $table = 'Pays';
    protected $fillable = [
        'nom',
        'actif',
    ];

   
     // Relation : Un pays a plusieurs villes.
   
    public function villes()
    {
        return $this->hasMany(Ville::class);
    }
}
