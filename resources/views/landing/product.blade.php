@extends('layouts.landing')

@section('content')
    <!-- Navbar Spacer -->
    <div class="h-20 bg-white"></div>

    <!-- Breadcrumb -->
    <div class="bg-gray-50 py-4 border-b border-gray-200">
        <div class="container mx-auto px-6 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-[#99010A] transition">{{ __('Home') }}</a>
            <span class="mx-2">/</span>
            <a href="{{ route('shop') }}" class="hover:text-[#99010A] transition">{{ __('Shop All') }}</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900 font-medium">{{ $product->name }}</span>
        </div>
    </div>

    <!-- Product Details -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16">
                <!-- Image Gallery -->
                <div x-data="{ activeImage: '{{ asset('storage/' . $product->image_path) }}' }">
                    <div class="aspect-[4/5] bg-gray-100 rounded-2xl overflow-hidden mb-4 relative group">
                        @if($product->image_path)
                            <img :src="activeImage" alt="{{ $product->name }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <i class="fas fa-image text-4xl"></i>
                            </div>
                        @endif
                        
                        @if($product->stock && $product->stock->quantity == 0)
                            <div class="absolute top-4 left-4 bg-gray-900 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                Sold Out
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Product Info -->
                <div class="flex flex-col justify-center">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-serif">{{ $product->name }}</h1>
                    
                    <div class="flex items-center gap-4 mb-6">
                        <span class="text-2xl font-bold text-[#99010A]">Rp {{ number_format($product->price_retail, 0, ',', '.') }}</span>
                        @if($product->stock && $product->stock->quantity > 0)
                            <span class="text-xs font-bold bg-green-100 text-green-700 px-3 py-1 rounded-full uppercase tracking-wide">In Stock</span>
                        @else
                             <span class="text-xs font-bold bg-gray-100 text-gray-600 px-3 py-1 rounded-full uppercase tracking-wide">Out of Stock</span>
                        @endif
                    </div>

                    <div class="prose prose-sm text-gray-600 mb-8 leading-relaxed whitespace-pre-line">
                        {{ $product->description }}
                    </div>

                    <!-- Actions -->
                    <div class="border-t border-b border-gray-100 py-6 my-2 space-y-4">
                        @auth
                            @if(auth()->user()->role === 'customer')
                                <form action="{{ route('customer.orders.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <!-- A simplified 'Add to Cart' or 'Buy Now' flow could go here. 
                                         For now, linking to the customer order creation page if standard flow 
                                         or just showing a 'Buy Now' button that redirects to login/register for guests. 
                                    -->
                                    <a href="{{ route('customer.orders.create') }}" class="block w-full text-center bg-[#99010A] text-white font-bold py-4 rounded-xl hover:bg-black transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                        Buy Now
                                    </a>
                                </form>
                            @else
                                <div class="p-4 bg-gray-50 rounded-lg text-sm text-gray-600">
                                    Logged in as {{ ucfirst(auth()->user()->role) }}. <a href="{{ route('dashboard') }}" class="text-[#99010A] underline">Go to Dashboard</a>
                                </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="block w-full text-center bg-[#99010A] text-white font-bold py-4 rounded-xl hover:bg-black transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                {{ __('Sign In') }} to Purchase
                            </a>
                            <p class="text-center text-sm text-gray-500 mt-2">
                                New here? <a href="{{ route('register') }}" class="text-[#99010A] font-bold hover:underline">Register now</a>
                            </p>
                        @endauth
                    </div>

                    <!-- Value Props -->
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div class="flex items-center gap-3 text-sm text-gray-600">
                            <i class="fas fa-check-circle text-[#99010A]"></i>
                            <span>100% Authentic</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm text-gray-600">
                            <i class="fas fa-check-circle text-[#99010A]"></i>
                            <span>BPOM Certified</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm text-gray-600">
                            <i class="fas fa-truck text-[#99010A]"></i>
                            <span>Fast Shipping</span>
                        </div>
                         <div class="flex items-center gap-3 text-sm text-gray-600">
                            <i class="fas fa-shield-alt text-[#99010A]"></i>
                            <span>Secure Payment</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <section class="py-16 bg-gray-50 border-t border-gray-200">
        <div class="container mx-auto px-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-8 font-serif">You May Also Like</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                    <a href="{{ route('product.show', $related->slug) }}" class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition duration-300 block">
                        <div class="aspect-[4/5] bg-gray-100 overflow-hidden relative">
                             @if($related->image_path)
                                <img src="{{ asset('storage/' . $related->image_path) }}" alt="{{ $related->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <i class="fas fa-image text-3xl"></i>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-sm text-gray-900 mb-1 truncate">{{ $related->name }}</h3>
                            <p class="text-[#99010A] font-bold text-sm">Rp {{ number_format($related->price_retail, 0, ',', '.') }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection
