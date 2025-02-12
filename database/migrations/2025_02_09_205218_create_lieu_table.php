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
        Schema::create('Lieu', function (Blueprint $table) {
            $table->id();
            $table->string('rue',64); 
            $table->integer('noCivic'); 
            $table->string('codePostal',10); 
            $table->string('nomEtablissement',64); 
            $table->string('photoLieu',64)->nullable(); 
            $table->string('siteWeb',64)->nullable(); 
            $table->string('numeroTelephone',15); 
            $table->boolean('actif')->default(true); 
            $table->text('description',500)->nullable(); 
            $table->foreignId('quartierId')->constrained('Quartier')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('typeLieuId')->constrained('TypeLieu')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('proprietaireId')->constrained('Usager')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Lieu');
    }
};
