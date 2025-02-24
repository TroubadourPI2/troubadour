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
        return $this->belongsToMany(Lieu::class, 'LieuActivites', 'activite_id', 'lieu_id');
    }

    public function favoris()
    {
        return $this->hasMany(Favori::class, 'activite_id'); 
    }
    public function photos()
    {
        return $this->hasMany(Photo::class, 'activite_id')->orderBy('position');
    }
    public function getPhotosJsonAttribute()
    {
    return $this->photos
        ->pluck('chemin')
        ->map(function($chemin) {
            return asset($chemin);
        })
        ->values()
        ->toJson();
    }

    public function getLieuIdsAttribute()
    {
        return $this->lieux->pluck('id')->implode(',');
    }
    

    public function typeActivite()
    {
    return $this->belongsTo(TypeActivite::class, 'typeActivite_id');
    }

}
