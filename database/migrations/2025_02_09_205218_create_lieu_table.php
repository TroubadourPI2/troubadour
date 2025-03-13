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
        Schema::create('Lieux', function (Blueprint $table) {
            $table->id();
            $table->string('rue',64); 
            $table->integer('noCivic'); 
            $table->string('codePostal',10); 
            $table->string('nomEtablissement',64); 
            $table->string('photoLieu',64)->nullable(); 
            $table->string('siteWeb',150)->nullable(); 
            $table->string('numeroTelephone',15); 
            $table->boolean('actif')->default(true); 
            $table->text('description',500)->nullable(); 
            $table->foreignId('quartier_id')->constrained('Quartiers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('typeLieu_id')->constrained('TypeLieux')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('proprietaire_id')->constrained('Usagers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Lieux');
    }
};
