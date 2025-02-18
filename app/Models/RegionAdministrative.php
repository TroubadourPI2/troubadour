<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionAdministrative extends Model
{
    use HasFactory;
    protected $table = 'RegionAdministratives';

    protected $fillable = [
        'nom',
        'actif',
        'province_id',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function villes()
    {
        return $this->hasMany(Ville::class);
    }
}
