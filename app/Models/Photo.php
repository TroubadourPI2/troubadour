<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'position',
        'chemin',
        'activite_id'
    ];

    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }
}
