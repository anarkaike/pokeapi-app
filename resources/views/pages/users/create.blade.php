<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('users.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Cadastrar Novo Usuário') }}
            </h2>
        </div>
    </x-slot>

    <x-box-container padding="xl">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            @include('pages.users.form')

            <div class="flex items-center justify-end border-t border-gray-100 mt-6">
                <a href="{{ route('users.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                    {{ __('Cancelar') }}
                </a>
                <x-buttons.primary-button class="bg-blue-600 hover:bg-blue-700">
                    {{ __('Salvar Usuário') }}
                </x-buttons.primary-button>
            </div>
        </form>
    </x-box-container>
</x-app-layout>
