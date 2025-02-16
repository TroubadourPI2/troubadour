<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeLieu extends Model
{
    use HasFactory;
    protected $table = 'TypeLieux';

    protected $fillable = [
        'nom',
    ];

    public function lieux()
    {
        return $this->hasMany(Lieu::class);
    }
}
