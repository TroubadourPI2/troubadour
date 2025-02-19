<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 
        'dateDebut', 
        'dateFin',
        'description',
        'actif',
        'lieu_id',
        'typeActivite_id'
    ];

    public function lieux() {
        return $this->belongsToMany(Lieu::class);
    }

    public function favoris()
    {
        return $this->hasMany(Favori::class, 'activite_id'); 
    }
}
