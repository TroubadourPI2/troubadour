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
        'typeActivite_id'
    ];

    public function lieux() {
        return $this->belongsToMany(Lieu::class);
    }

    public function favoris()
    {
        return $this->hasMany(Favori::class, 'activite_id'); 
    }
    public function photos()
    {
        return $this->hasMany(Photo::class, 'activite_id');
    }
    public function typeActivite()
    {
    return $this->belongsTo(TypeActivite::class, 'typeActivite_id');
    }

}
