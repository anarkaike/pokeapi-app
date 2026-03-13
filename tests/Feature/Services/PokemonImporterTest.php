<?php

namespace Tests\Feature\Services;

use App\DTOs\PokemonData;
use App\Models\Pokemon;
use App\Services\PokemonImporter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PokemonImporterTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_imports_pokemon_data_correctly()
    {
        $dto = new PokemonData(
            apiId:      1,
            name:       'nametest',
            height:     7,
            weight:     69,
            spriteUrl: 'url',
            types:      ['typetest1', 'typetest2'],
            abilities:  ['abilitiestest'],
            moves:      ['movestest']
        );

        $importer = new PokemonImporter();
        $pokemon  = $importer->import($dto);

        $this->assertDatabaseHas('pokemons', ['api_id' => 1, 'name' => 'Nametest']);
        $this->assertCount(2, $pokemon->types);
        $this->assertEquals('typetest1', $pokemon->types->first()->name);
    }

    public function test_it_does_not_duplicate_pokemon_on_multiple_imports()
    {
        $dto      = new PokemonData(1, 'nametest', 7, 69, 'url', ['typestest'], ['abilitiestest'], ['movestest']);
        $importer = new PokemonImporter();

        $importer->import($dto);
        $importer->import($dto);

        $this->assertEquals(1, Pokemon::count());
    }

    public function test_it_normalizes_pokemon_names_before_saving()
    {
        $dto = new PokemonData(25, 'nametest', 4, 60, 'url', [], [], []);

        $importer = new PokemonImporter();
        $importer->import($dto);

        $this->assertDatabaseHas('pokemons', ['name' => 'Nametest']);
    }
}
