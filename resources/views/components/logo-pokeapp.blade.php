@props([
    'width' => 'w-[100%]',
    'height' => 'h-auto',
    'class' => '',
])
<img src="{{ asset('images/logo.png') }}" alt="PokéAPI Logo"
    {{ $attributes->merge(['class' => "$width $height $class"]) }}>
