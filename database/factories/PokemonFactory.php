<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{ Pokemon, Type, Ability, Move };

/**
 * @extends Factory<Pokemon>
 */
class PokemonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'api_id'     => fake()->unique()->numberBetween(1, 10000),
            'name'       => ucfirst(fake()->word()),
            'height'     => fake()->numberBetween(1, 20),
            'weight'     => fake()->numberBetween(10, 1000),
            'sprite_url' => 'https://ipe.digital/wp-content/themes/bootscore-child-main/img/logo/logo.svg?t=' . fake()->numberBetween(1, 151),
        ];
    }

    /**
     * Indicate that the model should be created with related types, abilities, and moves.
     */
    public function withAttributes(): static
    {
        return $this->afterCreating(function (Pokemon $pokemon) {
            $pokemon->types()     ->attach(Type::factory(2)     ->create());
            $pokemon->abilities() ->attach(Ability::factory(2)  ->create());
            $pokemon->moves()     ->attach(Move::factory(4)     ->create());
        });
    }
}
