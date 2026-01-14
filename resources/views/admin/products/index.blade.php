<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-[#99010A]">Product List</h3>
                        <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-[#99010A] text-white rounded hover:bg-red-800">
                            + Add Product
                        </a>
                    </div>
                    
                    @if (session('success'))
                        <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-2 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead>
                                <tr class="bg-[#FEFBEC] text-left">
                                    <th class="py-2 px-4 border-b">Image</th>
                                    <th class="py-2 px-4 border-b">Name</th>
                                    <th class="py-2 px-4 border-b">Admin Price</th>
                                    <th class="py-2 px-4 border-b">Retail Price</th>
                                    <th class="py-2 px-4 border-b">Stock</th>
                                    <th class="py-2 px-4 border-b">Status</th>
                                    <th class="py-2 px-4 border-b">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-2 px-4 border-b">
                                            @if($product->image_path)
                                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded">
                                            @else
                                                <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center text-xs text-gray-500">No Img</div>
                                            @endif
                                        </td>
                                        <td class="py-2 px-4 border-b font-medium">{{ $product->name }}</td>
                                        <td class="py-2 px-4 border-b">Rp {{ number_format($product->price_admin, 0, ',', '.') }}</td>
                                        <td class="py-2 px-4 border-b">Rp {{ number_format($product->price_retail, 0, ',', '.') }}</td>
                                        <td class="py-2 px-4 border-b font-bold {{ $product->stock->quantity < 10 ? 'text-red-500' : 'text-green-600' }}">
                                            {{ $product->stock->quantity ?? 0 }}
                                        </td>
                                        <td class="py-2 px-4 border-b">
                                            @if($product->is_active)
                                                <span class="px-2 text-xs rounded-full bg-green-100 text-green-800">Active</span>
                                            @else
                                                <span class="px-2 text-xs rounded-full bg-red-100 text-red-800">Inactive</span>
                                            @endif
                                        </td>
                                        
                                        <td class="py-2 px-4 border-b">
                                            <div class="flex items-center gap-3">
                                                <a href="{{ route('admin.products.edit', $product->id) }}" class="flex items-center justify-center w-8 h-8 rounded bg-yellow-100 text-yellow-700 hover:bg-yellow-200 transition" title="Edit">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                </a>
                                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?');" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="flex items-center justify-center w-8 h-8 rounded bg-red-100 text-red-700 hover:bg-red-200 transition" title="Delete">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
