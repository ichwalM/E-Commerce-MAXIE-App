<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Maxie Skincare') }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    


    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    


    <style>
        [x-cloak] { display: none !important; }
        .font-heading { font-family: 'Instrument Sans', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900 font-sans antialiased selection:bg-[#99010A] selection:text-white" x-data="{ mobileMenuOpen: false, searchOpen: false }">
    
    <x-navbar />

    <main class="min-h-[60vh]">
        {{ $slot }}
    </main>
    
    <x-footer />

    <style>
        @keyframes fade-in-up {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fade-in-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
        }
    </style>
</body>
</html>
