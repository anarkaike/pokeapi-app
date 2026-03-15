@php
    $alerts = [
        'success' => 'bg-green-600',
        'error' => 'bg-red-600',
        'alert' => 'bg-yellow-500',
        'info' => 'bg-blue-500',
    ];

    $type = null;
    $message = null;
    $bgClass = '';

    foreach ($alerts as $key => $color) {
        if (session()->has($key)) {
            $type = $key;
            $message = session($key);
            $bgClass = $color;
            break;
        }
    }
@endphp

@if ($type)
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
        x-transition:enter="transition duration-300 transform" x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-end="opacity-0 translate-x-full"
        class="fixed bottom-4 right-4 z-50 flex min-w-64 items-center justify-between gap-4 rounded-lg shadow-lg px-4 py-3 text-sm font-medium text-white {{ $bgClass }}">

        <p>{{ $message }}</p>

        <button @click="show = false" class="text-lg opacity-70 transition-opacity hover:opacity-100 focus:outline-none">
            &times;
        </button>
    </div>
@endif
