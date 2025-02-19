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
        Schema::create('Villes', function (Blueprint $table) {
            $table->id();
            $table->string('nom',64);
            $table->boolean('actif')->default(true);
            $table->foreignId('region_id')->nullable()->constrained('RegionAdministratives')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('pays_id')->constrained('Pays')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Villes');
    }
};
