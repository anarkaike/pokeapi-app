@props(['class' => false, 'padding' => 'p-1'])

@php
    $paddingMap = [
        'xs' => 'p-1',
        'sm' => 'p-2',
        'md' => 'p-3',
        'lg' => 'p-4',
        'xl' => 'p-5',
    ];
@endphp

<div class="my-5 max-w-7xl mx-auto {{ $class }}">
    <div class="bg-white/85 shadow-sm rounded-lg mx-5">
        <div class="{{ $paddingMap[$padding] ?? $padding }}  text-gray-900">
            {{ $slot }}
        </div>
    </div>
</div>
