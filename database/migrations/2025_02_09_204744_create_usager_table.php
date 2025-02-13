<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Usager', function (Blueprint $table) {
            $table->id();
            $table->string('courriel',64)->unique();
            $table->string('password');
            $table->string('prenom',32);
            $table->string('nom',32);
            $table->foreignId('statutId')->constrained('Statut')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('roleId')->constrained('RoleUsager')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usager');
    }
};
