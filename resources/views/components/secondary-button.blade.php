@props(['href' => null, 'border' => true])

@php
    $baseClasses =
        'inline-flex items-center px-4 py-2 bg-white rounded-md text-xs tracking-widest transition ease-in-out duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 shadow-sm hover:bg-gray-50';

    // Lógica de borda e cores
    $borderClasses = $border
        ? 'border border-gray-300 text-gray-700 font-semibold uppercase'
        : 'text-gray-400 hover:text-gray-900';

    $classes = "$baseClasses $borderClasses";
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'button', 'class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
