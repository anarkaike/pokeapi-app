<x-app-layout>
    <x-slot name="header">
        <div class="py-[5px]">{{ __('Painel de Controle') }}</div>
    </x-slot>

    <x-box-container padding="xl">
        <h3 class="flex items-center gap-2 mb-6 text-xs font-bold tracking-widest text-gray-400 uppercase">
            <x-icons.shield-icon />
            Quantidade de Usuários por Tipo
        </h3>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <x-card-stats :value="$stats['users']['admin']" label="Administradores" bg="bg-blue-50" border="border-blue-200"
                valueColor="text-blue-700" labelColor="text-blue-500" />

            <x-card-stats :value="$stats['users']['editor']" label="Editores" bg="bg-indigo-50" border="border-indigo-200"
                valueColor="text-indigo-700" labelColor="text-indigo-500" />

            <x-card-stats :value="$stats['users']['viewer']" label="Visualizadores" bg="bg-cyan-50" border="border-cyan-200"
                valueColor="text-cyan-700" labelColor="text-cyan-500" />
        </div>
    </x-box-container>

    <x-box-container padding="xl">
        <h3 class="flex items-center gap-2 mb-6 text-xs font-bold tracking-widest text-gray-400 uppercase">
            <x-icons.database-icon />
            Banco de Dados Local
        </h3>

        <div class="grid grid-cols-2 gap-6 md:grid-cols-4">
            <x-card-stats :value="$stats['pokemon']['total']" label="Pokémons" valueColor="text-green-700" labelColor="text-green-500" />

            <x-card-stats :value="$stats['pokemon']['types']" label="Tipos" valueColor="text-yellow-700" labelColor="text-yellow-500" />
            <x-card-stats :value="$stats['pokemon']['abilities']" label="Habilidades" valueColor="text-blue-700" labelColor="text-blue-500" />
            <x-card-stats :value="$stats['pokemon']['moves']" label="Movimentos" valueColor="text-red-700" labelColor="text-red-500" />
        </div>
    </x-box-container>
</x-app-layout>
