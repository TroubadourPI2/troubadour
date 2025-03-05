<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statut extends Model
{
   use HasFactory;
   protected $table = 'Statuts';

   public function usager()
   {
       return $this->hasMany(Usager::class);
   }
}
