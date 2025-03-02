<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
    protected $casts = [
        'actif' => 'boolean',
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
    {   //TODO A CHANGER EN PROD POUR LE BON CHEMIN
        return $this->photos
            ->map(function ($photo) {
        
                return asset('storage/Images/' . $photo->chemin);
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
