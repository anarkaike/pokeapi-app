<?php

namespace Tests\Feature\Services;

use App\Contracts\PokeApiInterface;
use App\DTOs\PokemonData;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PokeApiClientTest extends TestCase
{
    public function test_it_can_fetch_a_pokemon_and_return_dto()
    {
        Http::fake([
            'pokeapi.co/*' => Http::response([
                'id' => 25,
                'name' => 'nametest',
                'height' => 4,
                'weight' => 60,
                'sprites' => ['other' => ['official-artwork' => ['front_default' => 'url']]],
                'types' => [['type' => ['name' => 'typetest']]],
                'abilities' => [['ability' => ['name' => 'abilitiestest']]],
                'moves' => [['move' => ['name' => 'movestest']]],
            ], 200)
        ]);

        $service = app(PokeApiInterface::class);
        $pokemon = $service->fetchPokemon('nametest');

        $this->assertInstanceOf(PokemonData::class, $pokemon);
        $this->assertEquals('nametest', $pokemon->name);
        $this->assertEquals(25, $pokemon->apiId);
    }

    public function test_it_caches_pokemon_data()
    {
        Http::fake([
            'pokeapi.co/*' => Http::response([
                'id' => 25,
                'name' => 'nametest',
                'height' => 4,
                'weight' => 60,
                'sprites' => ['other' => ['official-artwork' => ['front_default' => 'url']]],
                'types' => [], 'abilities' => [], 'moves' => []
            ], 200)
        ]);

        $service = app(PokeApiInterface::class);

        $service->fetchPokemon('nametest');
        $service->fetchPokemon('nametest');

        Http::assertSentCount(1);
    }

    public function test_it_throws_friendly_exception_on_api_failure()
    {
        Http::fake(['pokeapi.co/*' => Http::response([], 500)]);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Não foi possível obter os dados do Pokémon agora.");

        $service = app(PokeApiInterface::class);
        $service->fetchPokemon('any-pokemon');
    }
}
