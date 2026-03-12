<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\{ Facades\Hash, Str };
use App\{ Enums\UserRole, Models\User };

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'              => fake()->name(),
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => static::$password ??= Hash::make('password'),
            'remember_token'    => Str::random(10),
            'role'              => UserRole::VIEWER,
        ];
    }

    /**
     * Indicate that the model's role should be admin.
     */
    public function admin(): static
    {
        return $this->state(fn () => ['role' => UserRole::ADMIN]);
    }

    /**
     * Indicate that the model's role should be editor.
     */
    public function editor(): static
    {
        return $this->state(fn () => ['role' => UserRole::EDITOR]);
    }

    /**
     * Indicate that the model's role should be viewer.
     */
    public function viewer(): static
    {
        return $this->state(fn () => ['role' => UserRole::VIEWER]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
