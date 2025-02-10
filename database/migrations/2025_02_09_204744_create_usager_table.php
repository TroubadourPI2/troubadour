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
        Schema::create('usager', function (Blueprint $table) {
            $table->id();
            $table->string('courriel')->unique();
            $table->string('password');
            $table->string('prenom');
            $table->string('nom');
            $table->foreignId('statutId')->constrained('statut')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('roleUsagerId')->constrained('role_usager')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usager');
    }
};
