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
                <div class="px-6 py-20 md:px-12 lg:pr-24 order-2 md:order-1 text-center md:text-left">
                    <span class="text-[#99010A] font-bold tracking-widest uppercase text-xs mb-4 block animate-fade-in-up">New Arrival</span>
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6 animate-fade-in-up" style="animation-delay: 0.1s">
                        Clean Beauty, <br>
                        <span class="text-gray-400 font-light italic">Real Results.</span>
                    </h1>
                    <p class="text-gray-500 text-lg mb-8 max-w-md mx-auto md:mx-0 animate-fade-in-up" style="animation-delay: 0.2s">
                        Formulated with clinical precision and natural ingredients to restore your skin's health and vitality.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start animate-fade-in-up" style="animation-delay: 0.3s">
                        <a href="#shop" class="px-10 py-4 bg-[#99010A] text-white font-semibold hover:bg-black transition duration-300">
                            Shop Now
                        </a>
                        <a href="#about" class="px-10 py-4 border border-gray-300 hover:border-black font-semibold transition duration-300">
                            Learn More
                        </a>
                    </div>
                </div>
                <div class="relative h-[400px] md:h-full w-full order-1 md:order-2 bg-gray-200">
                   <div class="absolute inset-0 flex items-center justify-center bg-gray-100 text-gray-300">
                       <img src="{{ asset('images/hero.webp') }}" class="w-full h-full object-cover">
                   </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Value Propositions -->
    <section class="border-y border-gray-100 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="space-y-2">
                    <i class="fas fa-truck text-2xl text-gray-400 mb-2"></i>
                    <h3 class="font-bold text-sm uppercase tracking-wider">Fast Shipping</h3>
                    <p class="text-xs text-gray-500">Free delivery over 500k</p>
                </div>
                <div class="space-y-2">
                    <i class="fas fa-leaf text-2xl text-gray-400 mb-2"></i>
                    <h3 class="font-bold text-sm uppercase tracking-wider">Organic</h3>
                    <p class="text-xs text-gray-500">100% natural ingredients</p>
                </div>
                <div class="space-y-2">
                    <i class="fas fa-shield-alt text-2xl text-gray-400 mb-2"></i>
                    <h3 class="font-bold text-sm uppercase tracking-wider">Secure</h3>
                    <p class="text-xs text-gray-500">Safe payment processing</p>
                </div>
                <div class="space-y-2">
                    <i class="fas fa-headset text-2xl text-gray-400 mb-2"></i>
                    <h3 class="font-bold text-sm uppercase tracking-wider">Support</h3>
                    <p class="text-xs text-gray-500">24/7 dedicated support</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Collection -->
    <section id="shop" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-[#99010A] font-bold tracking-widest uppercase text-xs mb-3 block">Selected For You</span>
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Our Best Sellers</h2>
            <p class="text-gray-500">Explore our most popular formulations designed for radiant skin.</p>
        </div>

        @if($products->isEmpty())
             <div class="text-center py-24 bg-gray-50 rounded-lg">
                <i class="fas fa-box-open text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">No products available at the moment.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-12 gap-x-8">
                @foreach($products as $product)
                    <div class="group relative">
                        <!-- Image -->
                        <div class="aspect-[4/5] bg-gray-100 overflow-hidden relative mb-4">
                             @if($product->image_path)
                                <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                    <i class="fas fa-image text-3xl"></i>
                                </div>
                            @endif
                            
                            <!-- Overlay Action -->
                            <div class="absolute inset-x-0 bottom-0 p-4 translate-y-full group-hover:translate-y-0 transition duration-300">
                                <button class="w-full bg-white text-black font-semibold py-3 text-sm hover:bg-[#99010A] hover:text-white transition shadow-lg">
                                    Quick Add
                                </button>
                            </div>
                            
                            <!-- Badges -->
                            <div class="absolute top-3 left-3 flex flex-col gap-2">
                                <span class="bg-white/90 backdrop-blur text-[10px] font-bold px-2 py-1 uppercase tracking-wide">New</span>
                            </div>
                        </div>
                        
                        <!-- Info -->
                        <div class="space-y-1 text-center">
                            <h3 class="text-base font-medium text-gray-900">
                                <a href="#" class="hover:text-[#99010A] transition">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $product->name }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-500">{{ Str::limit($product->description, 40) }}</p>
                            <p class="text-sm font-bold text-[#99010A] mt-2">Rp {{ number_format($product->price_retail, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        
        <div class="text-center mt-16">
            <a href="#" class="inline-block border-b-2 border-black pb-1 font-semibold hover:text-[#99010A] hover:border-[#99010A] transition">View All Products</a>
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
