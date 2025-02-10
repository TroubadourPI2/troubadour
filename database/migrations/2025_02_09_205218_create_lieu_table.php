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
        Schema::create('lieu', function (Blueprint $table) {
            $table->id();
            $table->string('rue'); 
            $table->integer('noCivic'); 
            $table->string('codePostal'); 
            $table->string('nomEtablissement'); 
            $table->string('photoLieu')->nullable(); 
            $table->string('siteWeb')->nullable(); 
            $table->string('numeroTelephone'); 
            $table->boolean('actif')->default(true); 
            $table->text('description')->nullable(); 
            $table->foreignId('villeId')->constrained('ville')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('typeLieuId')->constrained('type_lieu')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('proprietaireId')->constrained('usager')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lieu');
    }
};
