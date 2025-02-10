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
        Schema::create('activite', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); 
            $table->date('dateDebut'); 
            $table->date('dateFin')->nullable(); 
            $table->boolean('actif')->default(true); 
            $table->text('description')->nullable();
            $table->foreignId('lieuId')->constrained('lieu')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('typeActiviteId')->constrained('type_activite')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activite');
    }
};
