<x-guest-layout>
    <!-- Header -->
    <div class="bg-gray-50 pt-32 pb-12">
        <div class="container mx-auto px-6 text-center">
            <span class="text-[#99010A] font-bold tracking-widest uppercase text-xs mb-3 block">Customer Favorites</span>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 font-serif">Best Sellers</h1>
            <p class="text-gray-500 mt-4 max-w-xl mx-auto">Our most loved and highly rated products, chosen by you.</p>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="container mx-auto px-6 py-12">
        @if($products->isEmpty())
             <div class="text-center py-24 bg-gray-50 rounded-lg">
                <i class="fas fa-box-open text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">No sales data available yet.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach($products as $index => $product)
                    <div class="group bg-white rounded-xl overflow-hidden border border-gray-100 hover:shadow-xl transition duration-300 relative">
                        <!-- Ranking Badge -->
                        <div class="absolute top-4 left-4 z-10 bg-[#99010A] text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                            #{{ $index + 1 }} Best Seller
                        </div>

                        <!-- Image -->
                        <div class="relative aspect-[4/5] bg-gray-100 overflow-hidden">
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-50">
                                    <i class="fas fa-image text-3xl"></i>
                                </div>
                            @endif
                            
                            <!-- Overlay Actions -->
                            <div class="absolute inset-x-0 bottom-0 p-4 translate-y-full group-hover:translate-y-0 transition duration-300">
                                <a href="{{ route('customer.products.index') }}" class="block w-full py-3 bg-white/90 backdrop-blur text-[#99010A] font-bold text-center rounded-lg hover:bg-[#99010A] hover:text-white transition shadow-lg">
                                    View Details
                                </a>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-5">
                            <h3 class="font-bold text-lg text-gray-900 mb-1 font-heading group-hover:text-[#99010A] transition">{{ $product->name }}</h3>
                            <p class="text-xs text-gray-500 mb-3">{{ $product->sold_count ?? 0 }} active units sold</p>
                            <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $product->description }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-[#99010A]">Rp {{ number_format($product->price_retail, 0, ',', '.') }}</span>
                                <div class="flex text-yellow-400 text-xs">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-guest-layout>
