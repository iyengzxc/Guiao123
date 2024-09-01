<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="{{ asset('nav.css') }}">

    <!-- Scripts -->
    
</head>
<body class="font-sans text-gray-900 ">
    
    <div class="logo-container flex justify-center items-center">
    <a href="/">
        <img src="{{ asset('Guiao Logo2.png') }}" alt="Guiao Logo" class="w-60 h-30" />
    </a>
</div>

        <div class="w-full sm:max-w-md mt-1 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
