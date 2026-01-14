<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shop Maxie Skincare') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-6 text-[#99010A]">Our Products</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($products as $product)
                            <div class="border rounded-lg p-4 shadow-sm hover:shadow-lg transition group">
                                <div class="relative overflow-hidden rounded mb-4">
                                    @if($product->image_path)
                                        <img src="{{ asset('storage/' . $product->image_path) }}" class="w-full h-48 object-cover group-hover:scale-110 transition duration-300">
                                    @else
                                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">No Image</div>
                                    @endif
                                </div>
                                
                                <h4 class="font-bold text-lg mb-1">{{ $product->name }}</h4>
                                <p class="text-[#99010A] font-bold text-xl mb-3">Rp {{ number_format($product->price_retail, 0, ',', '.') }}</p>
                                
                                <a href="{{ route('customer.orders.create', ['product_id' => $product->id]) }}" class="block text-center w-full py-2 bg-[#99010A] text-white rounded font-medium hover:bg-red-800 transition">
                                    Buy Now
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
