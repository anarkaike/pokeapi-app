<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Usuários') }}
            </h2>
            <a href="{{ route('users.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
                + Novo Usuário
            </a>
        </div>
    </x-slot>

    <x-box-container class="p-0 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-4">Nome</th>
                        <th scope="col" class="px-6 py-4">E-mail</th>
                        <th scope="col" class="px-6 py-4">Cargo</th>
                        <th scope="col" class="px-6 py-4 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="bg-white border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $user->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="bg-gray-100 text-gray-800 text-[10px] font-bold px-2 py-1 rounded uppercase border border-gray-200">
                                    {{ $user->role->label() ?? $user->role }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-3">
                                @can('update', $user)
                                    <a href="{{ route('users.edit', $user) }}"
                                        class="inline-block text-blue-500 hover:text-blue-700" title="Editar">
                                        <x-icons.edit-icon />
                                    </a>
                                @endcan

                                @can('delete', $user)
                                    <x-buttons.delete-button :action="route('users.destroy', $user)" :title="__('Excluir Usuário?')"
                                        description="Remover {{ ucfirst($user->name) }}?"
                                        class="text-red-500 hover:text-red-700 transition-colors" />
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center">
                                <p class="text-gray-500">Nenhum usuário cadastrado.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-box-container>

    <x-box-container padding="xs">
        <x-pagination :currentPage="$currentPage" :totalPages="$totalPages" routeName="pokemons.index" />
    </x-box-container>

</x-app-layout>
