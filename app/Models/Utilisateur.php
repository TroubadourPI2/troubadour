<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Utilisateur extends Model
{
    use HasFactory, Authenticatable, CanResetPassword, Notifiable;

    protected $fillable = [
       'prenom', 'nom', 'email', 'mdp',
    ];
}
