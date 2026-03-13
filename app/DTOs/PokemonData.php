<?php
namespace App\DTOs;

readonly class PokemonData
{
    public function __construct(
        public int      $apiId,
        public string   $name,
        public int      $height,
        public int      $weight,
        public string   $spriteUrl,
        public array    $types,
        public array    $abilities,
        public array    $moves,
    ) {}

    /**
     * Create a PokemonData instance from the API response data.
     */
    public static function fromApi(array $data): self
    {
        return new self(
            apiId:      $data['id'],
            name:       $data['name'],
            height:     $data['height'],
            weight:     $data['weight'],
            spriteUrl:  data_get($data, 'sprites.other.official-artwork.front_default') ?? 'https://ipe.digital/wp-content/themes/bootscore-child-main/img/logo/logo.svg?t=' . fake()->numberBetween(1, 151),
            types:      collect($data['types'])     ->pluck('type.name')            ->toArray(),
            abilities:  collect($data['abilities']) ->pluck('ability.name')         ->toArray(),
            moves:      collect($data['moves'])     ->take(5)->pluck('move.name')   ->toArray(),
        );
    }
}
