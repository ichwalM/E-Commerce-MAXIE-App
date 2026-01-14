<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Maxie Skincare') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">
        
        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm md:hidden"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            style="display: none;"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-[#99010A] to-[#7A0108] text-white transition-transform duration-300 ease-in-out md:static md:translate-x-0 flex flex-col shadow-2xl">
            
            <!-- Logo -->
            <div class="flex items-center justify-center h-20 border-b border-white/10 bg-white/5">
                <div class="text-center">
                    <h1 class="text-2xl font-bold tracking-wider">MAXIE</h1>
                    <p class="text-[10px] text-red-200 uppercase tracking-[0.2em]">Skincare System</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1">
                
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-white/20 shadow-inner' : 'hover:bg-white/10' }}">
                    <svg class="w-5 h-5 mr-3 text-red-100 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                @if(Auth::user()->role === 'admin')
                    <div class="mt-6 mb-2 px-4 text-xs font-semibold text-red-300 uppercase tracking-wider">Admin Controls</div>
                    
                    <a href="{{ route('admin.distributors.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.distributors.*') ? 'bg-white/20 shadow-inner' : 'hover:bg-white/10' }}">
                        <svg class="w-5 h-5 mr-3 text-red-100 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span class="font-medium">Distributors</span>
                    </a>
                    
                    <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.products.*') ? 'bg-white/20 shadow-inner' : 'hover:bg-white/10' }}">
                        <svg class="w-5 h-5 mr-3 text-red-100 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        <span class="font-medium">Products</span>
                    </a>
                    
                    <a href="{{ route('admin.stock.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.stock.*') ? 'bg-white/20 shadow-inner' : 'hover:bg-white/10' }}">
                        <svg class="w-5 h-5 mr-3 text-red-100 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        <span class="font-medium">Stock</span>
                    </a>
                    
                    <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.orders.*') ? 'bg-white/20 shadow-inner' : 'hover:bg-white/10' }}">
                        <svg class="w-5 h-5 mr-3 text-red-100 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span class="font-medium">Orders</span>
                    </a>
                @endif

                @if(Auth::user()->role === 'distributor')
                    <div class="mt-6 mb-2 px-4 text-xs font-semibold text-red-300 uppercase tracking-wider">Business</div>
                    
                    <a href="{{ route('distributor.stock.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('distributor.stock.*') ? 'bg-white/20 shadow-inner' : 'hover:bg-white/10' }}">
                        <svg class="w-5 h-5 mr-3 text-red-100 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <span class="font-medium">Inventory</span>
                    </a>

                    <a href="{{ route('distributor.orders.create') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('distributor.orders.create') ? 'bg-white/20 shadow-inner' : 'hover:bg-white/10' }}">
                        <svg class="w-5 h-5 mr-3 text-red-100 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-medium">Restock</span>
                    </a>

                    <a href="{{ route('distributor.sales.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('distributor.sales.*') ? 'bg-white/20 shadow-inner' : 'hover:bg-white/10' }}">
                        <svg class="w-5 h-5 mr-3 text-red-100 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-medium">Incoming Sales</span>
                    </a>

                    <a href="{{ route('distributor.reports.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('distributor.reports.*') ? 'bg-white/20 shadow-inner' : 'hover:bg-white/10' }}">
                         <svg class="w-5 h-5 mr-3 text-red-100 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <span class="font-medium">Reports</span>
                    </a>

                    <a href="{{ route('distributor.orders.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('distributor.orders.index') ? 'bg-white/20 shadow-inner' : 'hover:bg-white/10' }}">
                        <svg class="w-5 h-5 mr-3 text-red-100 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                       <span class="font-medium">History</span>
                   </a>
                @endif

                @if(Auth::user()->role === 'customer')
                    <div class="mt-6 mb-2 px-4 text-xs font-semibold text-red-300 uppercase tracking-wider">Shop</div>
                    
                    <a href="{{ route('customer.products.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('customer.products.*') ? 'bg-white/20 shadow-inner' : 'hover:bg-white/10' }}">
                        <svg class="w-5 h-5 mr-3 text-red-100 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span class="font-medium">Catalog</span>
                    </a>

                    <a href="{{ route('customer.orders.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('customer.orders.*') ? 'bg-white/20 shadow-inner' : 'hover:bg-white/10' }}">
                        <svg class="w-5 h-5 mr-3 text-red-100 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span class="font-medium">My Orders</span>
                    </a>
                @endif

                <div class="mt-6 mb-2 px-4 text-xs font-semibold text-red-300 uppercase tracking-wider">Account</div>
                
                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('profile.edit') ? 'bg-white/20 shadow-inner' : 'hover:bg-white/10' }}">
                    <svg class="w-5 h-5 mr-3 text-red-100 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <span class="font-medium">Profile</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-4 py-3 rounded-lg transition-all duration-200 group hover:bg-white/10 text-left">
                        <svg class="w-5 h-5 mr-3 text-red-100 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span class="font-medium">Log Out</span>
                    </button>
                </form>

            </nav>

            <!-- User Footer -->
            <div class="p-4 border-t border-white/10 bg-black/10">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                         <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center text-white font-bold text-lg">
                             {{ substr(Auth::user()->name, 0, 1) }}
                         </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-red-200 truncate">{{ ucfirst(Auth::user()->role) }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Mobile Header -->
            <header class="md:hidden bg-[#99010A] text-white p-4 flex justify-between items-center shadow-md z-20">
                <span class="font-bold text-lg">MAXIE Skincare</span>
                <button @click="sidebarOpen = !sidebarOpen" class="focus:outline-none p-1 rounded-md hover:bg-white/10 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </header>

            <!-- Desktop Header (Optional, mostly for title/actions) -->
            <header class="bg-white border-b border-gray-200 hidden md:flex items-center justify-between px-8 py-4 sticky top-0 z-10">
                <h2 class="font-bold text-2xl text-gray-800 tracking-tight">
                    {{ $header ?? 'Dashboard' }} 
                </h2>
                <div class="flex items-center space-x-4">
                     <!-- Notifications or other actions -->
                     <div class="text-sm text-gray-500">Welcome, <span class="text-[#99010A] font-semibold">{{ Auth::user()->name }}</span></div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-4 md:p-8 scroll-smooth">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
