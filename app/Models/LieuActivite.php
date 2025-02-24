<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LieuActivite extends Model
{   use HasFactory;
    protected $table = 'LieuActivites';
    protected $fillable = [
        'activite_id', 
        'lieu_id', 
    ];


}
