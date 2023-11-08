<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="grid grid-cols-5 grid-rows-1">
            <div class="col-span-3">
                <div class="py-4">
                    <img class="" src="https://sedema.cdmx.gob.mx/storage/app/uploads/public/613/fc9/f2b/613fc9f2b0c4d250881339.jpeg" alt="">
                </div>
            </div>
            <div class="col-span-2 bg-yellow-400 font-sans text-gray-900 antialiased">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
