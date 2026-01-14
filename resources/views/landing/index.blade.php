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
    
    <!-- Navbar Component -->
    <x-navbar />

    <!-- Hero Section -->
    <header class="relative bg-[#F9F9F9] overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 min-h-[600px] items-center">
                <div class="px-6 py-20 md:px-12 lg:pr-24 order-2 md:order-1 text-center md:text-left" x-data>
                    <span class="text-[#99010A] font-bold tracking-widest uppercase text-xs mb-4 block reveal-hidden" x-intersect="$el.classList.add('reveal-visible')">{{ __('New Arrival') }}</span>
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6 reveal-hidden delay-100" x-intersect="$el.classList.add('reveal-visible')">
                        {{ __('Clean Beauty, Real Results') }}
                    </h1>
                    <p class="text-gray-500 text-lg mb-8 max-w-md mx-auto md:mx-0 reveal-hidden delay-200" x-intersect="$el.classList.add('reveal-visible')">
                        {{ __('Formulated with clinical') }}
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start reveal-hidden delay-300" x-intersect="$el.classList.add('reveal-visible')">
                        <a href="{{ route('customer.products.index') }}" class="px-10 py-4 bg-[#99010A] text-white font-semibold hover:bg-black transition duration-300 shadow-xl hover:shadow-2xl hover:-translate-y-1">
                            {{ __('Shop Now') }}
                        </a>
                        <a href="{{ route('about') }}" class="px-10 py-4 border border-gray-300 hover:border-black font-semibold transition duration-300 hover:bg-gray-50">
                            {{ __('Learn More') }}
                        </a>
                    </div>
                </div>
                <div class="relative h-[400px] md:h-full w-full order-1 md:order-2 bg-gray-200 overflow-hidden" x-data>
                   <div class="absolute inset-0 flex items-center justify-center bg-gray-100 text-gray-300 reveal-hidden delay-200" x-intersect="$el.classList.add('reveal-visible')">
                       <img src="{{ asset('images/hero.webp') }}" class="w-full h-full object-cover hover:scale-105 transition duration-1000 ease-in-out">
                   </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Value Propositions -->
    <section class="border-y border-gray-100 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center" x-data>
                <div class="space-y-2 reveal-hidden delay-100" x-intersect="$el.classList.add('reveal-visible')">
                    <i class="fas fa-truck text-2xl text-gray-400 mb-2"></i>
                    <h3 class="font-bold text-sm uppercase tracking-wider">{{ __('Fast Shipping') }}</h3>
                    <p class="text-xs text-gray-500">{{ __('Free delivery') }}</p>
                </div>
                <div class="space-y-2 reveal-hidden delay-200" x-intersect="$el.classList.add('reveal-visible')">
                    <i class="fas fa-leaf text-2xl text-gray-400 mb-2"></i>
                    <h3 class="font-bold text-sm uppercase tracking-wider">{{ __('Organic') }}</h3>
                    <p class="text-xs text-gray-500">{{ __('Natural ingredients') }}</p>
                </div>
                <div class="space-y-2 reveal-hidden delay-300" x-intersect="$el.classList.add('reveal-visible')">
                    <i class="fas fa-shield-alt text-2xl text-gray-400 mb-2"></i>
                    <h3 class="font-bold text-sm uppercase tracking-wider">{{ __('Secure') }}</h3>
                    <p class="text-xs text-gray-500">{{ __('Safe payment') }}</p>
                </div>
                <div class="space-y-2 reveal-hidden delay-400" x-intersect="$el.classList.add('reveal-visible')">
                    <i class="fas fa-headset text-2xl text-gray-400 mb-2"></i>
                    <h3 class="font-bold text-sm uppercase tracking-wider">{{ __('Support') }}</h3>
                    <p class="text-xs text-gray-500">{{ __('Dedicated support') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Collection -->
    <section id="shop" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16" x-data>
            <span class="text-[#99010A] font-bold tracking-widest uppercase text-xs mb-3 block reveal-hidden" x-intersect="$el.classList.add('reveal-visible')">{{ __('Selected For You') }}</span>
            <h2 class="text-3xl md:text-4xl font-bold mb-4 reveal-hidden delay-100" x-intersect="$el.classList.add('reveal-visible')">{{ __('Products') }}</h2>
            <p class="text-gray-500 reveal-hidden delay-200" x-intersect="$el.classList.add('reveal-visible')">{{ __('Explore popular') }}</p>
        </div>

        @if($products->isEmpty())
             <div class="text-center py-24 bg-gray-50 rounded-lg">
                <i class="fas fa-box-open text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">{{ __('No products') }}</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach($products as $index => $product)
                <!-- Product Card -->
                    <a  href="{{ route('shop') }}" class="group cursor-pointer reveal-hidden delay-{{ ($index % 3) * 100 + 100 }}" x-data x-intersect="$el.classList.add('reveal-visible')">
                        <div class="relative overflow-hidden bg-gray-100 aspect-[4/5] mb-4 rounded-sm">
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition duration-700 ease-in-out group-hover:scale-110">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <i class="fas fa-image text-3xl"></i>
                                </div>
                            @endif
                            
                            <div class="p-4">
                                <h3 class="font-bold text-sm uppercase tracking-wider">{{ $product->name }}</h3>
                                <p class="text-sm text-gray-500">{{ Str::limit($product->description, 40) }}</p>
                                <p class="text-sm font-bold text-[#99010A] mt-2">Rp {{ number_format($product->price_retail, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
        
        <div class="text-center mt-16">
            <a href="{{ route('customer.products.index') }}" class="inline-block border-b-2 border-black pb-1 font-semibold hover:text-[#99010A] hover:border-[#99010A] transition">View All Products</a>
        </div>
    </section>

    <!-- Promo Banner -->
    <section class="py-24 bg-[#111111] text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h2 class="text-3xl md:text-5xl font-bold mb-6">Join the Maxie Glow Club</h2>
            <p class="text-gray-400 max-w-2xl mx-auto mb-10 text-lg">Sign up for our newsletter to receive exclusive offers, skincare tips, and early access to new launches.</p>
            
            <form class="max-w-md mx-auto flex gap-2">
                <input type="email" placeholder="Enter your email" class="flex-1 bg-white/10 border border-white/20 text-white placeholder-gray-500 px-4 py-3 focus:outline-none focus:border-[#99010A] focus:ring-1 focus:ring-[#99010A] transition">
                <button type="button" class="bg-[#99010A] hover:bg-white hover:text-[#99010A] text-white px-8 py-3 font-bold transition duration-300">
                    SUBSCRIBE
                </button>
            </form>
        </div>
    </section>

    <!-- Footer Component -->
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
