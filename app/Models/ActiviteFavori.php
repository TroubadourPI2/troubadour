<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiviteFavori extends Model
{
    use HasFactory;
    protected $table = 'ActiviteFavoris';


    protected $table = 'ActiviteFavoris';
    
    protected $fillable = [
        'activite_id', 
        'usager_id'
    ];

    public function activite() {
        return $this->belongsTo(Activite::class);
    }

    public function usager() {
        return $this->belongsTo(Usager::class);
    }

}
