
<!-- Announcement Bar -->
<div class="bg-[#99010A] text-white text-xs font-medium py-2.5 text-center tracking-wide">
    FREE SHIPPING ON ORDERS OVER 500K IDR • GLOBAL SHIPPING AVAILABLE
</div>

<!-- Normalize Navbar (Standard E-Commerce) -->
<nav class="sticky top-0 z-50 transition-all duration-300" 
     x-data="{ scrolled: false }" 
     @scroll.window="scrolled = (window.pageYOffset > 20)"
     :class="{ 'bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-100': scrolled, 'bg-white border-b border-transparent': !scrolled }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Mobile Menu Button -->
            <button type="button" class="md:hidden p-2 text-gray-600 hover:text-black transition-transform active:scale-95" @click="mobileMenuOpen = !mobileMenuOpen">
                <i class="fas fa-bars text-xl"></i>
            </button>

            <!-- Logo -->
            <a href="{{route('home')}}" class="flex items-center gap-2 group">
                <div class="w-8 h-8 bg-[#99010A] text-white flex items-center justify-center font-bold rounded-sm group-hover:bg-black transition-colors duration-300">M</div>
                <span class="text-xl font-bold tracking-tighter uppercase transition-colors duration-300">Maxie<span class="font-light text-gray-400">Skincare</span></span>
            </a>

            <!-- Desktop Nav -->
            <div class="hidden md:flex items-center space-x-10 text-sm font-medium tracking-wide uppercase text-gray-500">
                <a href="{{route('home')}}" class="hover:text-[#99010A] transition-colors relative group">
                    {{ __('Home') }}
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#99010A] transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{route('shop')}}" class="hover:text-[#99010A] transition-colors relative group">
                    {{ __('Shop All') }}
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#99010A] transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{route('best-sellers')}}" class="hover:text-[#99010A] transition-colors relative group">
                    {{ __('Best Sellers') }}
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#99010A] transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{route('about')}}" class="hover:text-[#99010A] transition-colors relative group">
                    {{ __('About Us') }}
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#99010A] transition-all duration-300 group-hover:w-full"></span>
                </a>
            </div>

            <!-- Icons -->
            <div class="flex items-center space-x-5">
                <button class="text-gray-600 hover:text-[#99010A] transition-transform hover:scale-110" @click="searchOpen = !searchOpen">
                    <i class="fas fa-search text-lg"></i>
                </button>
                
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-[#99010A] transition-transform hover:scale-110">
                        <i class="far fa-user text-lg"></i>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-[#99010A] transition font-medium text-sm hidden md:block hover:underline">
                        Sign In
                    </a>
                @endauth

                <a href="#" class="text-gray-600 hover:text-[#99010A] transition-transform hover:scale-110 relative">
                    <i class="fas fa-shopping-bag text-lg"></i>
                    <span class="absolute -top-1.5 -right-1.5 w-4 h-4 bg-[#99010A] text-white text-[10px] flex items-center justify-center rounded-full font-bold shadow-sm">0</span>
                </a>

                <!-- Language Switcher -->
                <div class="flex items-center text-xs font-bold gap-2 border-l border-gray-200 pl-4 ml-2">
                    <a href="{{ route('lang.switch', 'id') }}" class="{{ app()->getLocale() == 'id' ? 'text-[#99010A]' : 'text-gray-400 hover:text-black' }} transition">ID</a>
                    <span class="text-gray-300">|</span>
                    <a href="{{ route('lang.switch', 'en') }}" class="{{ app()->getLocale() == 'en' ? 'text-[#99010A]' : 'text-gray-400 hover:text-black' }} transition">EN</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Overlay -->
    <div x-show="searchOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="absolute top-full left-0 w-full bg-white border-b border-gray-100 p-4 shadow-xl z-40" @click.away="searchOpen = false" x-cloak>
        <div class="max-w-3xl mx-auto flex items-center gap-4">
            <i class="fas fa-search text-gray-400"></i>
            <input type="text" placeholder="Search for products..." class="w-full border-none focus:ring-0 text-lg bg-transparent placeholder-gray-300">
            <button @click="searchOpen = false" class="text-gray-400 hover:text-black transition-transform hover:rotate-90"><i class="fas fa-times"></i></button>
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
        <a href="/" class="block hover:text-[#99010A]">Home</a>
        <a href="{{route('shop')}}" class="block hover:text-[#99010A]">Shop All</a>
        <a href="{{route('best-sellers')}}" class="block hover:text-[#99010A]">Best Sellers</a>
        <a href="{{route('about')}}" class="block hover:text-[#99010A]">About Us</a>
        <hr class="border-gray-100">
        @auth
            <a href="{{ url('/dashboard') }}" class="block text-base text-gray-500">My Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="block text-base text-gray-500">Sign In</a>
            <a href="{{ route('register') }}" class="block text-base text-gray-500">Create Account</a>
        @endauth
    </div>
</div>