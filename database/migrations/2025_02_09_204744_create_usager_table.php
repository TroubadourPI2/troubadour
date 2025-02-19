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
        Schema::create('Usagers', function (Blueprint $table) {
            $table->id();
            $table->string('courriel',64)->unique();
            $table->string('password');
            $table->string('prenom',32);
            $table->string('nom',32);
            $table->rememberToken();
            $table->foreignId('statut_id')->constrained('Statuts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('role_id')->constrained('RoleUsagers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Usagers');
    }
};
