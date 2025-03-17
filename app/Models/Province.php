<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table = 'Provinces';
    protected $fillable = [
        'nom',
        'actif',
    ];

    public function regions()
    {
        return $this->hasMany(RegionAdministrative::class);
    }

}
