@props(['tooltip' => 'Este campo é obrigatório'])

<span x-data="{ open: false }" class="relative inline-flex items-center">
    <span @mouseenter="open = true" @mouseleave="open = false" class="text-red-500 cursor-help font-bold">
        *
    </span>
    <div x-show="open" x-cloak
        class="absolute z-50 p-2 whitespace-nowrap text-xs text-white bg-gray-900 rounded-lg shadow-xl -top-12 left-1/2 transform -translate-x-1/2 pointer-events-none">
        {{ $tooltip }}
        <div class="absolute -bottom-1 left-1/2 -ml-1.5 border-4 border-transparent border-t-gray-900"></div>
    </div>
</span>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
