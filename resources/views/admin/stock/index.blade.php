<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Stock Supply') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4 text-[#99010A]">Inventory Management</h3>
                    
                     @if (session('success'))
                        <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-2 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if ($errors->any())
                        <div class="mb-4 font-medium text-sm text-red-600 bg-red-100 p-2 rounded">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($products as $product)
                            <div class="border rounded-lg p-4 shadow-sm hover:shadow-md transition">
                                <div class="flex items-center gap-4 mb-3">
                                    @if($product->image_path)
                                        <img src="{{ asset('storage/' . $product->image_path) }}" class="w-16 h-16 object-cover rounded">
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center text-xs">No Img</div>
                                    @endif
                                    <div>
                                        <h4 class="font-bold text-gray-800">{{ $product->name }}</h4>
                                        <p class="text-sm text-gray-500">Current Stock: <span class="font-bold text-[#99010A]">{{ $product->stock->quantity ?? 0 }}</span></p>
                                    </div>
                                </div>
                                
                                <form action="{{ route('admin.stock.update') }}" method="POST" class="mt-2">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="flex gap-2">
                                        <select name="operation" class="text-sm border-gray-300 rounded focus:ring-[#99010A] focus:border-[#99010A]">
                                            <option value="add">Add (+)</option>
                                            <option value="subtract">Remove (-)</option>
                                        </select>
                                        <input type="number" name="quantity" min="1" placeholder="Qty" class="w-20 text-sm border-gray-300 rounded focus:ring-[#99010A] focus:border-[#99010A]" required>
                                        <button type="submit" class="bg-[#99010A] text-white px-3 py-1 rounded text-sm hover:bg-red-800">Update</button>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
