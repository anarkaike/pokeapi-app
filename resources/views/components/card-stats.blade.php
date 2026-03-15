@props([
    'value',
    'label',
    'bg' => 'bg-white/45',
    'border' => 'border-gray-200',
    'valueColor' => 'text-gray-800',
    'labelColor' => 'text-gray-500',
])

<div class="p-6 text-center border-2 rounded-2xl {{ $bg }} {{ $border }}">
    <div class="mb-1 text-3xl font-black leading-none {{ $valueColor }}">
        {{ $value }}
    </div>
    <div class="text-xs font-semibold tracking-tight uppercase {{ $labelColor }}">
        {{ $label }}
    </div>
</div>
