<x-app-layout>

    <x-slot name="header">{{ __('Meu Perfil') }}</x-slot>

    <x-box-container>
        @include('profile.partials.update-profile-information-form')
    </x-box-container>

    <x-box-container>
        @include('profile.partials.update-password-form')
    </x-box-container>

    <x-box-container>
        @include('profile.partials.delete-user-form')
    </x-box-container>

</x-app-layout>
