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
        Schema::create('RegionAdministratives', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->boolean('actif')->default(true);
            $table->foreignId('province_id')->nullable()->constrained('Provinces')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('RegionAdministratives');
    }
};
