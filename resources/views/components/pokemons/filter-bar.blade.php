<form method="GET" action="{{ route('pokemons.index') }}"
    class="flex flex-col sm:flex-row gap-2 items-center justify-between">

    <div class="flex-1 w-full relative">
        <input type="text" name="search" value="{{ request('search') }}" autofocus
            placeholder="Buscar Pokémon por nome..."
            class="w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-xl shadow-sm sm:text-sm">
    </div>

    <div class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
        <div
            class="flex items-center flex-auto sm:flex-1 bg-white px-3 py-2 rounded-xl border border-gray-300 shadow-sm h-[42px]">
            <select name="sync_status" onchange="this.form.submit()"
                class="border-none bg-transparent focus:ring-0 text-sm font-bold text-gray-700 cursor-pointer py-0 pl-1 pr-8">
                <option value="all"
                    {{ request('sync_status') === 'all' || request('sync_status') === '' ? 'selected' : '' }}>
                    {{ __('Todos os Status') }}
                </option>
                <option value="synced" {{ request('sync_status') === 'synced' ? 'selected' : '' }}>
                    {{ __('Sincronizados') }}</option>
                <option value="unsynced" {{ request('sync_status') === 'unsynced' ? 'selected' : '' }}>
                    {{ __('Não Sincronizados') }}</option>
            </select>
        </div>

        <div
            class="flex items-center  flex-auto sm:flex-1 space-x-2 bg-white px-4 py-2 rounded-xl border border-gray-300 shadow-sm h-[42px]">
            <input type="checkbox" id="favorites" name="favorites" value="1"
                {{ request('favorites') ? 'checked' : '' }}
                class="rounded border-gray-300 text-yellow-500 shadow-sm focus:ring-yellow-500 w-5 h-5 cursor-pointer"
                onchange="this.form.submit()">
            <label for="favorites"
                class="text-sm font-bold text-gray-700 cursor-pointer select-none flex items-center gap-1">
                <span>{{ __('Favoritos') }}</span>
                <x-icons.star filled class="text-yellow-500 size-4" />
            </label>
        </div>
    </div>

    <div class="flex space-x-3 w-full sm:w-auto">
        <x-buttons.primary-button type="submit" class="w-full sm:w-auto justify-center h-[42px]">
            {{ __('Filtrar') }}
        </x-buttons.primary-button>

        @if (request('search') || request('favorites') || (request('sync_status') && request('sync_status') !== 'all'))
            <a href="{{ route('pokemons.index') }}"
                class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition ease-in-out duration-150 h-[42px]">
                {{ __('Limpar') }}
            </a>
        @endif
    </div>
</form>
