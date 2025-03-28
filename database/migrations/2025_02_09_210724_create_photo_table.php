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
        Schema::create('Photos', function (Blueprint $table) {
            $table->id();
            $table->string('nom',64);
            $table->integer('position'); 
            $table->string('chemin',255);
            $table->foreignId('activite_id')->constrained('Activites')->cascadeOnUpdate()->cascadeOnDelete();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Photos');
    }
};
