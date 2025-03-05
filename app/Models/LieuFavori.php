<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LieuFavori extends Model
{
    use HasFactory;

    protected $table = 'LieuFavoris';
    
    protected $fillable = [
        'lieu_id', 
        'usager_id'
    ];

    public function lieu() {
        return $this->belongsTo(Lieu::class);
    }

    public function usager() {
        return $this->belongsTo(Usager::class);
    }

}
