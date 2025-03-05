<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Usager extends Authenticatable
{
    use HasFactory, Notifiable ;

    protected $fillable = [
        'courriel',
        'password',
        'prenom',
        'nom',
        'statut_id',
        'role_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(RoleUsager::class, 'role_id');
    }

    public function lieu(){
        return $this->hasMany(Lieu::class, 'proprietaire_id');
    }

    public function activiteFavoris(){
        return $this->hasMany(ActiviteFavori::class);
    }

    public function lieuFavoris(){
        return $this->hasMany(LieuFavori::class);
    }

}
