<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Request Stock') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ items: {} }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('distributor.orders.store') }}" method="POST">
                        @csrf
                        
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-[#99010A]">Product Catalog</h3>
                            <button type="submit" class="px-6 py-2 bg-[#99010A] text-white rounded font-bold hover:bg-red-800 disabled:opacity-50" :disabled="Object.keys(items).length === 0">
                                Place Order
                            </button>
                        </div>

                        @if ($errors->any())
                            <div class="mb-4 font-medium text-sm text-red-600 bg-red-100 p-2 rounded">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($products as $product)
                                <div class="border rounded-lg p-4 shadow-sm hover:shadow-md transition">
                                    <div class="flex flex-col items-center">
                                        @if($product->image_path)
                                            <img src="{{ asset('storage/' . $product->image_path) }}" class="w-full h-48 object-cover rounded mb-4">
                                        @else
                                            <div class="w-full h-48 bg-gray-200 rounded flex items-center justify-center text-gray-500 mb-4">No Image</div>
                                        @endif
                                        
                                        <h4 class="font-bold text-lg text-center">{{ $product->name }}</h4>
                                        <p class="text-[#99010A] font-bold mt-1">Rp {{ number_format($product->price_admin, 0, ',', '.') }}</p>
                                        
                                        <div class="mt-4 w-full">
                                            <div class="flex items-center justify-center gap-2">
                                                <button type="button" @click="if(items[{{ $product->id }}]) { items[{{ $product->id }}]--; if(items[{{ $product->id }}] <= 0) delete items[{{ $product->id }}]; }" class="w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300 flex items-center justify-center">-</button>
                                                <input type="number" readonly class="w-16 text-center border-none bg-transparent font-bold" :value="items[{{ $product->id }}] || 0">
                                                <button type="button" @click="items[{{ $product->id }}] = (items[{{ $product->id }}] || 0) + 1" class="w-8 h-8 rounded-full bg-[#99010A] text-white hover:bg-red-800 flex items-center justify-center">+</button>
                                            </div>
                                            <!-- Hidden inputs for form submission -->
                                            <template x-if="items[{{ $product->id }}]">
                                                <div>
                                                    <input type="hidden" name="items[{{ $product->id }}][product_id]" value="{{ $product->id }}">
                                                    <input type="hidden" name="items[{{ $product->id }}][quantity]" :value="items[{{ $product->id }}]">
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
