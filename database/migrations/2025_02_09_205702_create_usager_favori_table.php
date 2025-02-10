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
        Schema::create('usager_favori', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lieuId')->constrained('lieu')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('usagerId')->constrained('usager')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usager_favori');
    }
};
