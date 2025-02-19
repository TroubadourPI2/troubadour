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
        Schema::create('Favoris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activite_id')->constrained('Activites')->cascadeOnUpdate()->cascadeOnDelete()->nullable();
            $table->foreignId('lieu_id')->constrained('Lieux')->cascadeOnUpdate()->cascadeOnDelete()->nullable();
            $table->foreignId('usager_id')->constrained('Usagers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Favori');
    }
};
