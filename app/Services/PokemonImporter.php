<?php

namespace App\Services;

use App\DTOs\PokemonData;
use App\Models\{Pokemon, Type, Ability, Move};
use Illuminate\Support\Facades\{ DB, Log };
use Exception;

class PokemonImporter
{
    /**
     * Import or update a Pokémon in the local database based on data from the PokéAPI.
     *
     * @param PokemonData $data The data transfer object containing the Pokémon information fetched from the PokéAPI.
     * @return Pokemon The imported or updated Pokémon model instance.
     * @throws Exception
     */
    public function import(PokemonData $data): Pokemon
    {
        try {
            return DB::transaction(function () use ($data) {
                $pokemon = Pokemon::updateOrCreate(
                    ['api_id' => $data->apiId],
                    [
                        'name'       => ucfirst(strtolower($data->name)),
                        'height'     => $data->height,
                        'weight'     => $data->weight,
                        'sprite_url' => $data->spriteUrl,
                    ]
                );

                $pokemon->types()     ->sync($this->syncAttributes(Type::class,    $data->types));
                $pokemon->abilities() ->sync($this->syncAttributes(Ability::class, $data->abilities));
                $pokemon->moves()     ->sync($this->syncAttributes(Move::class,    $data->moves));

                Log::info("Pokémon importado/atualizado com sucesso: {$pokemon->name} (ID: {$pokemon->api_id})");

                return $pokemon;
            });
        } catch (Exception $e) {
            Log::error("Erro ao persistir Pokémon no banco: " . $e->getMessage(), [
                'api_id' => $data->apiId,
                'name'   => $data->name
            ]);
            throw new Exception("Erro interno ao salvar os dados do Pokémon.");
        }
    }

    /**
     * Helper for syncing related attributes (types, abilities, moves) and ensuring they exist in the database.
     *
     * @param string $model The Eloquent model class (Type, Ability, Move).
     * @param array $names An array of attribute names to sync.
     * @return array An array of IDs corresponding to the synced attributes.
     * @throws Exception
     */
    private function syncAttributes(string $model, array $names): array
    {
        $ids = [];
        foreach ($names as $name) {
            $record = $model::firstOrCreate(['name' => strtolower($name)]);
            $ids[]  = $record->id;
        }
        return $ids;
    }
}
