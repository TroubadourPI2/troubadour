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
        Schema::create('Quartiers', function (Blueprint $table) {
            $table->id();
            $table->string('nom',64);
            $table->boolean('actif')->default(true);
            $table->foreignId('ville_id')->constrained('Villes')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Quartiers');
    }
};
