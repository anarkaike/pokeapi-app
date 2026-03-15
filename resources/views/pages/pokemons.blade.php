<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Pokédex - Catálogo Pokémon') }}</h2>

            @can('import', App\Models\Pokemon::class)
                <x-buttons.sync-all-button />
            @endcan
        </div>
    </x-slot>

    @if ($pokemonDetail)
        <x-box-container padding="sm">
            <x-pokemons.detail-section :pokemon="$pokemonDetail" />
        </x-box-container>
    @endif

    <x-box-container padding="sm">
        <x-pokemons.filter-bar />
    </x-box-container>

    <x-box-container padding="sm">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2">

            @forelse ($pokemons as $pokemon)
                @php
                    $local = $localPokemons->get(strtolower($pokemon['name']));
                    $isSincronizado = $local !== null;
                    $isFavorite = $isSincronizado && $local->favoritedBy->contains('id', auth()->id());
                    $urlParts = explode('/', rtrim($pokemon['url'], '/'));
                    $pokeId = end($urlParts);
                    $imageUrl =
                        $isSincronizado && $local->sprite_url
                            ? $local->sprite_url
                            : "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/{$pokeId}.png"; // ... suas lógicas anteriores
                    $isSelected = request('selected') === $pokemon['name'];
                    $selectionUrl = request()->fullUrlWithQuery(['selected' => $pokemon['name']]);
                @endphp

                <x-pokemons.card :pokemon="$pokemon" :local="$local" :isSincronizado="$isSincronizado" :isFavorite="$isFavorite"
                    :isSelected="$isSelected" :selectionUrl="$selectionUrl" :imageUrl="$imageUrl" />

            @empty
                <x-empty-state :title="__('Nenhum Pokémon encontrado')" :resetRoute="route('pokemons.index')" :fields="['search', 'favorites', 'sync_status']" />
            @endforelse
        </div>
    </x-box-container>

    <x-box-container padding="xs">
        <x-pagination :currentPage="$currentPage" :totalPages="$totalPages" routeName="pokemons.index" />
    </x-box-container>

</x-app-layout>
