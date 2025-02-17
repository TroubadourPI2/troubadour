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
        'statutId',
        'roleId'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(RoleUsager::class, 'roleId');
    }

    public function lieu(){
        return $this->hasMany(Lieu::class, 'proprietaireId');
    }
}
