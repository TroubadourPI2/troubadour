<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lieu extends Model
{
    use HasFactory;
    protected $table = 'lieux';
    protected $fillable = [
        'rue',
        'noCivic',
        'nomEtablissement',
        'photoLieu',
        'siteWeb',
        'numeroTelephone',
        'description',
        'quartierId',
        'typeLieuId',
    ];

    // public function quartier(){
    //     return $this->hasOne(Quartier::class);
    // }
}
