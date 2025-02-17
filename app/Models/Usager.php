<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Usager extends Model
{
    use  Authenticatable, CanResetPassword, Notifiable;

    protected $table = 'Usagers';
    protected $fillable = [
       'courriel', 'password', 'prenom', 'nom', 'statutId', 'roleId'
    ];
}
