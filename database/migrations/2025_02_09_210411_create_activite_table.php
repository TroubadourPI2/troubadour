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
        Schema::create('Activites', function (Blueprint $table) {
            $table->id();
            $table->string('nom',64); 
            $table->date('dateDebut'); 
            $table->date('dateFin')->nullable(); 
            $table->boolean('actif')->default(true); 
            $table->text('description',500)->nullable();
            $table->foreignId('lieu_id')->constrained('Lieux')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('typeActivite_id')->constrained('TypeActivites')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Activites');
    }
};
