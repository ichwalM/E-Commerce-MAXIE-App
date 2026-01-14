<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Maxie Skincare') }}</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="bg-gray-50 text-gray-800 font-sans antialiased">
        <div class="min-h-screen flex flex-col justify-center items-center relative overflow-hidden">
            
            <!-- Background Decoration -->
            <div class="absolute inset-0 z-0 opacity-10">
                <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-[#99010A] blur-3xl"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] rounded-full bg-red-100 blur-3xl"></div>
                <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-[#99010A] blur-3xl"></div>
            </div>

            <div class="relative z-10 w-full max-w-4xl px-6 text-center">
                <!-- Logo -->
                <div class="mb-8 animate-fade-in-down">
                    <h1 class="text-6xl font-bold text-[#99010A] tracking-tight">MAXIE</h1>
                    <p class="text-xl text-gray-600 mt-2 font-medium tracking-widest uppercase">Skincare</p>
                </div>

                <!-- Card -->
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8 md:p-12 border border-white/50 animate-fade-in-up">
                    <h2 class="text-3xl font-semibold mb-6 text-gray-800">Welcome to Maxie Skincare System</h2>
                    <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                        Manage your inventory, process orders, and track sales efficiently with our dedicated distributor platform.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-8 py-3 bg-[#99010A] text-white font-semibold rounded-lg hover:bg-[#7A0108] transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    Go to Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="px-8 py-3 bg-[#99010A] text-white font-semibold rounded-lg hover:bg-[#7A0108] transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-[#99010A] border-2 border-[#99010A] font-semibold rounded-lg hover:bg-gray-50 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>

                <!-- Footer -->
                <footer class="mt-12 text-sm text-gray-500">
                    &copy; {{ date('Y') }} Maxie Skincare. All rights reserved.
                </footer>
            </div>
        </div>
        
        <style>
             @keyframes fade-in-down {
                0% { opacity: 0; transform: translateY(-20px); }
                100% { opacity: 1; transform: translateY(0); }
            }
            @keyframes fade-in-up {
                0% { opacity: 0; transform: translateY(20px); }
                100% { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in-down {
                animation: fade-in-down 0.8s ease-out;
            }
            .animate-fade-in-up {
                animation: fade-in-up 0.8s ease-out 0.2s both;
            }
        </style>
    </body>
</html>
