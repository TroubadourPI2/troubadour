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
        Schema::create('Recherches', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('villeId')->constrained('villes', 'id');
            $table->foreignId('quartierId')->constrained('quartiers', 'id');
            $table->string('termeRecherche', 64);
            $table->integer('nbOccurences');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Recherches');
    }
};
