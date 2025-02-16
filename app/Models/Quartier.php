<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quartier extends Model
{
    protected $fillable = [
        'nom',
        'actif',
        'regionId',
        'paysId',
    ];
}
