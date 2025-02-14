<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usager extends Model
{
    use HasFactory;

    protected $fillable = [
        'courriel',
        'password',
        'prenom',
        'nom',
        'siteWeb',
        'statutId',
    ];

    public function lieu(){
        return $this->hasMany(Lieu::class, 'proprietaireId');
    }
}
