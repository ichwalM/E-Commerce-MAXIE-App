<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Maxie Skincare') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        .font-heading { font-family: 'Instrument Sans', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900 font-sans antialiased selection:bg-[#99010A] selection:text-white" x-data="{ mobileMenuOpen: false, searchOpen: false }">
    
    <!-- Announcement Bar -->
    <div class="bg-[#99010A] text-white text-xs font-medium py-2.5 text-center tracking-wide">
        FREE SHIPPING ON ORDERS OVER 500K IDR • GLOBAL SHIPPING AVAILABLE
    </div>

    <!-- Normalize Navbar (Standard E-Commerce) -->
    <nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Mobile Menu Button -->
                <button type="button" class="md:hidden p-2 text-gray-600 hover:text-black" @click="mobileMenuOpen = !mobileMenuOpen">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <!-- Logo -->
                <a href="/" class="flex items-center gap-2 group">
                    <div class="w-8 h-8 bg-[#99010A] text-white flex items-center justify-center font-bold rounded-sm group-hover:bg-black transition">M</div>
                    <span class="text-xl font-bold tracking-tighter uppercase">Maxie<span class="font-light text-gray-400">Skincare</span></span>
                </a>

                <!-- Desktop Nav -->
                <div class="hidden md:flex items-center space-x-10 text-sm font-medium tracking-wide uppercase text-gray-500">
                    <a href="#" class="hover:text-[#99010A] transition">Shop All</a>
                    <a href="#" class="hover:text-[#99010A] transition">Best Sellers</a>
                    <a href="#" class="hover:text-[#99010A] transition">Bundles</a>
                    <a href="#" class="hover:text-[#99010A] transition">About Us</a>
                </div>

                <!-- Icons -->
                <div class="flex items-center space-x-5">
                    <button class="text-gray-600 hover:text-[#99010A] transition" @click="searchOpen = !searchOpen">
                        <i class="fas fa-search text-lg"></i>
                    </button>
                    
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-[#99010A] transition">
                            <i class="far fa-user text-lg"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-[#99010A] transition font-medium text-sm hidden md:block">
                            Sign In
                        </a>
                    @endauth

                    <a href="#" class="text-gray-600 hover:text-[#99010A] transition relative">
                        <i class="fas fa-shopping-bag text-lg"></i>
                        <span class="absolute -top-1.5 -right-1.5 w-4 h-4 bg-[#99010A] text-white text-[10px] flex items-center justify-center rounded-full font-bold">0</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Search Overlay -->
        <div x-show="searchOpen" x-transition.opacity class="absolute top-full left-0 w-full bg-white border-b border-gray-100 p-4 shadow-xl z-40" @click.away="searchOpen = false" x-cloak>
            <div class="max-w-3xl mx-auto flex items-center gap-4">
                <i class="fas fa-search text-gray-400"></i>
                <input type="text" placeholder="Search for products..." class="w-full border-none focus:ring-0 text-lg bg-transparent placeholder-gray-300">
                <button @click="searchOpen = false" class="text-gray-400 hover:text-black"><i class="fas fa-times"></i></button>
            </div>
        </div>
    </nav>
    
    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" class="fixed inset-0 z-40 bg-white" x-transition x-cloak>
        <div class="p-4 flex justify-between items-center border-b border-gray-100">
            <span class="font-bold text-lg">MENU</span>
            <button @click="mobileMenuOpen = false" class="p-2 text-2xl"><i class="fas fa-times"></i></button>
        </div>
        <div class="p-6 flex flex-col space-y-6 text-xl font-medium">
            <a href="#" class="block hover:text-[#99010A]">Shop All</a>
            <a href="#" class="block hover:text-[#99010A]">Best Sellers</a>
            <a href="#" class="block hover:text-[#99010A]">Bundles</a>
            <a href="#" class="block hover:text-[#99010A]">About Us</a>
            <hr class="border-gray-100">
            <a href="{{ route('login') }}" class="block text-base text-gray-500">Sign In</a>
            <a href="{{ route('register') }}" class="block text-base text-gray-500">Create Account</a>
        </div>
    </div>

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
                   <!-- Placeholder for a high-quality model shot -->
                   <div class="absolute inset-0 flex items-center justify-center bg-gray-100 text-gray-300">
                       <i class="fas fa-flask text-9xl opacity-20 transform rotate-12"></i>
                   </div>
                   <!-- You would usually put a <img src="..." class="w-full h-full object-cover"> here -->
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

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="space-y-6">
                    <span class="text-xl font-bold tracking-tighter uppercase block">Maxie<span class="font-light text-gray-400">Skincare</span></span>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Dedicated to bringing you the best in skincare innovation. Clean, effective, and accessible beauty for everyone.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-[#99010A] transition"><i class="fab fa-instagram text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-[#99010A] transition"><i class="fab fa-facebook text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-[#99010A] transition"><i class="fab fa-tiktok text-xl"></i></a>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-bold text-sm uppercase tracking-wider mb-6">Shop</h4>
                    <ul class="space-y-4 text-sm text-gray-500">
                        <li><a href="#" class="hover:text-black transition">All Products</a></li>
                        <li><a href="#" class="hover:text-black transition">Best Sellers</a></li>
                        <li><a href="#" class="hover:text-black transition">New Arrivals</a></li>
                        <li><a href="#" class="hover:text-black transition">Bundles</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-sm uppercase tracking-wider mb-6">Company</h4>
                    <ul class="space-y-4 text-sm text-gray-500">
                        <li><a href="#" class="hover:text-black transition">About Us</a></li>
                        <li><a href="#" class="hover:text-black transition">Careers</a></li>
                        <li><a href="#" class="hover:text-black transition">Press</a></li>
                        <li><a href="#" class="hover:text-black transition">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                   <h4 class="font-bold text-sm uppercase tracking-wider mb-6">Customer Care</h4>
                    <ul class="space-y-4 text-sm text-gray-500">
                        <li><a href="#" class="hover:text-black transition">Shipping & Returns</a></li>
                        <li><a href="#" class="hover:text-black transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-black transition">Terms & Conditions</a></li>
                        <li><a href="#" class="hover:text-black transition">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-100 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-gray-400">
                <p>&copy; {{ date('Y') }} Maxie Skincare. All rights reserved.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <i class="fab fa-cc-visa text-2xl"></i>
                    <i class="fab fa-cc-mastercard text-2xl"></i>
                    <i class="fab fa-cc-paypal text-2xl"></i>
                </div>
            </div>
        </div>
    </footer>
    
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
