<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Maxie Skincare') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FEFBEC] font-sans antialiased text-gray-900">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg border-t-4 border-[#99010A]">
            <div class="mb-6 text-center">
                <h1 class="text-3xl font-bold text-[#99010A]">MAXIE</h1>
                <p class="text-gray-500">Skincare</p>
            </div>
            
            {{ $slot }}
        </div>
    </div>
</body>
</html>
