@props(['image' => 'images/image.png', 'imageAlt' => 'Imagem', 'imageClass' => ''])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PokéApp') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    style="background-image: url('{{ asset('images/bg.png') }}'); background-size: cover; background-position: right bottom;">
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-200/50 p-10">

        <a href="/">
            <x-logo-app />
        </a>

        <div class="w-full sm:max-w-5xl m-5 p-10 bg-white rounded-2xl">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center py-2">
                <div class="flex justify-center">
                    <img src="{{ asset($image) }}" alt="{{ $imageAlt }}" class="{{ $imageClass }}" />
                </div>

                <div class="text-center md:text-left px-4 space-y-5">
                    {{ $slot }}
                </div>
            </div>

        </div>

        <x-logo-ipe-digital />

    </div>
</body>

</html>
