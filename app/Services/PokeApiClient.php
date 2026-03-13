<?php

namespace App\Services;

use App\DTOs\PokemonData;
use App\Contracts\PokeApiInterface;
use Illuminate\Support\Facades\{ Http, Cache, Log };
use Exception;

class PokeApiClient implements PokeApiInterface
{
    protected string $baseUrl  = 'https://pokeapi.co/api/v2';
    protected int    $cacheTtl = 600;

    /**
     * Fetch detailed Pokémon data.
     *
     * @param int|string $identifier The Pokémon's ID or name
     * @return PokemonData A data transfer object containing the Pokémon information.
     * @throws Exception
     */
    public function fetchPokemon(int|string $identifier): PokemonData
    {
        $cacheKey = "pokemon_api_data_" . strtolower($identifier);

        return Cache::remember($cacheKey, $this->cacheTtl, function () use ($identifier) {
            try {
                $response = Http::timeout(5)->retry(3, 100)->get("{$this->baseUrl}/pokemon/{$identifier}");

                if ($response->failed()) {
                    Log::warning("PokéAPI: Pokémon '{$identifier}' não encontrado ou erro na resposta.", [
                        'status' => $response->status(),
                        'identifier' => $identifier
                    ]);

                    throw new Exception("Pokémon não encontrado na PokéAPI.");
                }

                return PokemonData::fromApi($response->json());

            } catch (Exception $e) {
                Log::error('PokéAPI Integration Error: ' . $e->getMessage(), [
                    'identifier'    => $identifier,
                    'exception'     => $e
                ]);

                throw new Exception("Não foi possível obter os dados do Pokémon agora. Tente novamente em instantes.");
            }
        });
    }

    /**
     * Fetch a paginated list of Pokémon.
     *
     * @param int $limit The number of Pokémon to fetch per page
     * @param int $offset The offset for pagination
     * @return array An array containing the list of Pokémon and pagination info.
     * @throws Exception
     */
    public function fetchList(int $limit = 20, int $offset = 0): array
    {
        $cacheKey = "pokemon_list_l{$limit}_o{$offset}";

        return Cache::remember($cacheKey, $this->cacheTtl, function () use ($limit, $offset) {
            try {
                $response = Http::timeout(5)->retry(3, 100)->get("{$this->baseUrl}/pokemon", [
                    'limit' => $limit,
                    'offset' => $offset,
                ]);

                if ($response->failed()) {
                    throw new Exception("Erro ao carregar lista da API.");
                }

                return $response->json();

            } catch (Exception $e) {
                Log::critical("PokéAPI List Error: " . $e->getMessage());
                throw new Exception("Não foi possível listar os Pokémons agora.");
            }
        });
    }
}
