<?php

use Illuminate\Database\{ Migrations\Migration, Schema\Blueprint };
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pokemon_ability', function (Blueprint $table) {
            $table->foreignId('pokemon_id')->constrained('pokemons') ->cascadeOnDelete();
            $table->foreignId('ability_id')->constrained('abilities')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pokemon_ability');
    }
};
