<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeActivite extends Model
{
    use HasFactory;
    protected $table = 'TypeActivites';
    protected $fillable = [
        'nom'
    ];

    public function activites()
    {
        return $this->hasMany(Activite::class, 'typeActivite_id');
    }
}
