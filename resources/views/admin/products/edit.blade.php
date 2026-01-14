<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-xl font-bold mb-6 text-[#99010A]">Edit Product</h2>
                    
                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Product Name</label>
                            <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#99010A] focus:border-[#99010A]" required value="{{ old('name', $product->name) }}">
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Description</label>
                            <textarea name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#99010A] focus:border-[#99010A]">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Admin Price (Base)</label>
                                <input type="number" name="price_admin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#99010A] focus:border-[#99010A]" required value="{{ old('price_admin', $product->price_admin) }}">
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Retail Price (Suggested)</label>
                                <input type="number" name="price_retail" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#99010A] focus:border-[#99010A]" required value="{{ old('price_retail', $product->price_retail) }}">
                            </div>
                        </div>

                        <!-- Stock is managed separately or via restock flows, but visual indicator here? -->
                        <div class="bg-gray-100 p-3 rounded">
                            <span class="text-sm font-bold">Current Stock:</span> 
                            <span class="text-lg">{{ $product->stock->quantity ?? 0 }}</span>
                            <p class="text-xs text-gray-500">To add stock, use the Stock Supply feature.</p>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Status</label>
                            <select name="is_active" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#99010A] focus:border-[#99010A]">
                                <option value="1" {{ $product->is_active ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !$product->is_active ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Product Image (Optional)</label>
                            @if($product->image_path)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $product->image_path) }}" class="h-20 w-20 object-cover rounded border">
                                </div>
                            @endif
                            <input type="file" name="image" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        </div>

                        <div class="flex justify-end gap-2 mt-6">
                            <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Cancel</a>
                            <button type="submit" class="px-4 py-2 bg-[#99010A] text-white rounded hover:bg-red-800">Update Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
