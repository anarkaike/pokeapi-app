<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{ User, Pokemon };

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->admin() ->create([
            'email' => config('app.seeders.admin_email'),
            'password' => bcrypt(config('app.seeders.admin_password'))
        ]);
        User::factory()->editor()->create([
            'email' => config('app.seeders.editor_email'),
            'password' => bcrypt(config('app.seeders.editor_password'))
        ]);
        User::factory()->viewer()->create([
            'email' => config('app.seeders.viewer_email'),
            'password' => bcrypt(config('app.seeders.viewer_password'))
        ]);

        Pokemon::factory(20)->withAttributes()->create();
    }
}
