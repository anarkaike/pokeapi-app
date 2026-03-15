@props(['pokemon', 'local', 'isSincronizado', 'isFavorite'])

@if ($isSincronizado)
    <x-badge>
        {{ __('Sincronizado') }} <br />
        {{ $local->synced_at ? $local->synced_at->diffForHumans() : __('Agora') }}
    </x-badge>

    <div class="mt-auto flex items-center gap-2">

        @can('favorite', $local)
            <x-buttons.favorite-button :isFavorite="$isFavorite" :action="route('pokemons.favorite', $local)" />
        @endcan

        @can('delete', $local)
            <x-buttons.delete-button :action="route('pokemons.destroy', $local)" :title="__('Excluir Pokémon?')"
                description="Remover {{ ucfirst($local->name) }} do banco local?"
                class="text-red-500 hover:text-red-700 transition-colors" />
        @endcan

        @can('import', App\Models\Pokemon::class)
            <x-buttons.resync-button :action="route('pokemons.sync')" :pokemonName="$pokemon['name']" />
        @endcan

    </div>
@else
    <form action="{{ route('pokemons.sync') }}" method="POST" x-data="{ loading: false }" @submit="loading = true"
        class="mt-auto w-full flex justify-center mb-2">
        @csrf
        <input type="hidden" name="name" value="{{ $pokemon['name'] }}">

        @can('import', App\Models\Pokemon::class)
            <x-buttons.sync-button />
        @else
            <x-badge color="red">{{ __('Não Importado') }}</x-badge>
        @endcan
    </form>
@endif
