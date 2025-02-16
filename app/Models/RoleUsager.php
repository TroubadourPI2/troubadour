<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUsager extends Model
{
   use HasFactory;
   protected $table = 'RoleUsagers';

   public function usager()
   {
       return $this->hasMany(Usager::class, 'roleId');
   }
}
