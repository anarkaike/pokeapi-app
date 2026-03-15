@props(['mobile' => false])

@php
    $classes = $mobile ? 'space-y-1 justify-center text-center' : 'hidden space-x-1 sm:-my-px sm:ms-10 sm:flex';
    $linkClass = $mobile ? 'px-2 block' : 'px-5';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" :class="$linkClass">
        {{ __('Dashboard') }}
    </x-nav-link>
    <x-nav-link :href="route('pokemons.index')" :active="request()->routeIs('pokemons.index')" :class="$linkClass">
        {{ __('Pokémons') }}
    </x-nav-link>
    @can('viewAny', App\Models\User::class)
        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')" :class="$linkClass">
            {{ __('Usuários') }}
        </x-nav-link>
    @endcan
</div>
