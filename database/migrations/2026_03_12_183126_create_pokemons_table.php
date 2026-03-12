<?php

use Illuminate\Database\{ Migrations\Migration, Schema\Blueprint };
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pokemons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('api_id')->unique();
            $table->string('name');
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->string('sprite_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pokemons');
    }
};
