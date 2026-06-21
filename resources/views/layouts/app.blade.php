<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Bagmo — Blood Supply Chain</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-grid bg-surface min-h-screen">
        <div class="flex min-h-screen">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main -->
            <div class="flex-1 flex flex-col min-h-screen lg:ml-60">
                @include('layouts.navigation')
                <main class="flex-1 py-6 px-4 sm:px-6">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
