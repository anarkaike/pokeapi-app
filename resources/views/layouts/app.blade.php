@props(['pageTitle' => '', 'metaTitle' => ''])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $metaTitle ?? config('app.name', 'PokéApp') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body style="background-image: url('{{ asset('images/bg.png') }}');" class="bg-cover bg-right-bottom">
    <div class="min-h-screen flex flex-col bg-gray-200/50">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-white shadow">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </h2>
            </header>
        @endisset

        <main class="flex-grow bg-[length:30%] bg-no-repeat bg-[position:calc(100%-30px)_calc(100%-30px)]"
            style="background-image: url('{{ asset('images/image-plane.png') }}');">
            {{ $slot }}
        </main>


        @include('layouts.footer')
    </div>
</body>

</html>
