<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quartier extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'actif',
        'ville_id',
    ];

    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }

    public function lieux()
    {
        return $this->hasMany(Lieu::class);
    }
}
