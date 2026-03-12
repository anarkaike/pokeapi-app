<?php

use Illuminate\Database\{ Migrations\Migration, Schema\Blueprint };
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pokemon_type', function (Blueprint $table) {
            $table->foreignId('pokemon_id')->constrained('pokemons')->cascadeOnDelete();
            $table->foreignId('type_id')   ->constrained('types')   ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pokemon_type');
    }
};
