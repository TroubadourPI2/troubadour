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
        Schema::create('Activite', function (Blueprint $table) {
            $table->id();
            $table->string('nom',64); 
            $table->date('dateDebut'); 
            $table->date('dateFin')->nullable(); 
            $table->boolean('actif')->default(true); 
            $table->text('description',500)->nullable();
            $table->foreignId('lieuId')->constrained('Lieu')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('typeActiviteId')->constrained('TypeActivite')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Activite');
    }
};
