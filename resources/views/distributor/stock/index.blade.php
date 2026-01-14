<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Inventory') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4 text-[#99010A]">My Stock</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead>
                                <tr class="bg-[#FEFBEC] text-left">
                                    <th class="py-2 px-4 border-b">Product</th>
                                    <th class="py-2 px-4 border-b">Current Stock</th>
                                    <th class="py-2 px-4 border-b">Selling Price</th>
                                    <th class="py-2 px-4 border-b">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stocks as $stock)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-2 px-4 border-b flex items-center gap-2">
                                            @if($stock->product->image_path)
                                                <img src="{{ asset('storage/' . $stock->product->image_path) }}" class="w-8 h-8 rounded object-cover">
                                            @else
                                                <div class="w-8 h-8 bg-gray-200 rounded"></div>
                                            @endif
                                            {{ $stock->product->name }}
                                        </td>
                                        <td class="py-2 px-4 border-b">{{ $stock->quantity }}</td>
                                        <td class="py-2 px-4 border-b">
                                            Rp {{ number_format($stock->price_selling ?? $stock->product->price_retail, 0, ',', '.') }}
                                        </td>
                                        <td class="py-2 px-4 border-b">
                                            <button class="text-blue-600 hover:underline text-sm">Update Price</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                         @if($stocks->isEmpty())
                            <div class="text-center py-8 text-gray-500">
                                You have no stock. 
                                <a href="{{ route('distributor.orders.create') }}" class="text-[#99010A] underline">Request Restock</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
