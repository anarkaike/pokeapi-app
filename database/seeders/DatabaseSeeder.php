<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{ Pokemon, Ability, Move, Type };

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->admin()->create(['email' => 'admin@teste.com']);
        User::factory()->editor()->create(['email' => 'editor@teste.com']);
        User::factory()->create(['email' => 'viewer@teste.com']);

        Pokemon::factory(20)->withAttributes()->create();
    }
}
