<?php

use Illuminate\Database\{ Migrations\Migration, Schema\Blueprint };
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_favorites', function (Blueprint $table) {
            $table->foreignId('user_id')   ->constrained('users')   ->cascadeOnDelete();
            $table->foreignId('pokemon_id')->constrained('pokemons')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['user_id', 'pokemon_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_favorites');
    }
};
