<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiviteFavori extends Model
{
    use HasFactory;

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
