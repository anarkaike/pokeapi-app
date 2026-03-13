<?php

namespace App\Contracts;

use App\DTOs\PokemonData;

interface PokeApiInterface
{
    /**
     * Fetch detailed Pokémon data from the PokéAPI by ID or name, with caching and error handling.
     */
    public function fetchPokemon(int|string $identifier): PokemonData;

    /**
     * Fetch a paginated list of Pokémon from the PokéAPI, with caching and error handling.
     */
    public function fetchList(int $limit = 20, int $offset = 0): array;
}
