<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recherche extends Model
{
    use HasFactory;
    protected $table = 'Recherches';
    protected $fillable = [
        'termeRecherche',
        'nbOccurences',
    ];
}
