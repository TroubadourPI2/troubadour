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
        Schema::create('Ville', function (Blueprint $table) {
            $table->id();
            $table->string('nom',64);
            $table->boolean('actif')->default(true);
            $table->foreignId('regionId')->nullable()->constrained('RegionAdministrative')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('paysId')->constrained('Pays')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Ville');
    }
};
