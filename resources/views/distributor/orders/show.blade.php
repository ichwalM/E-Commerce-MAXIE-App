<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Header -->
                    <div class="flex justify-between items-start border-b pb-6 mb-6">
                        <div>
                            <h1 class="text-2xl font-bold text-[#99010A]">Invoice: {{ $order->invoice_no }}</h1>
                            <p class="text-gray-600 mt-1">Date: {{ $order->created_at->format('d F Y, H:i') }}</p>
                            <div class="mt-4">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold 
                                    {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="text-right">
                             <p class="text-sm text-gray-500">Seller</p>
                             <p class="font-bold text-lg">{{ $order->seller->name }}</p>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <h3 class="text-lg font-semibold mb-4 text-[#99010A]">Order Items</h3>
                    <div class="overflow-x-auto mb-8 border rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-[#FEFBEC]">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($order->items as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                @if($item->product->image_path)
                                                    <img class="h-10 w-10 rounded-full object-cover mr-3" src="{{ asset('storage/' . $item->product->image_path) }}" alt="">
                                                @endif
                                                <div class="text-sm font-medium text-gray-900">{{ $item->product->name }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $item->quantity }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-right font-bold text-gray-900">Total Amount</td>
                                    <td class="px-6 py-4 font-bold text-[#99010A] text-lg">
                                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    @if($order->notes)
                        <div class="mb-8 p-4 bg-gray-50 rounded-lg border">
                            <h4 class="font-bold text-sm text-gray-700 mb-2">Notes:</h4>
                            <p class="text-gray-600 italic">"{{ $order->notes }}"</p>
                        </div>
                    @endif

                    <!-- Actions -->
                    <div class="flex justify-end space-x-4 border-t pt-6">
                        <a href="{{ route('distributor.orders.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                            Back to History
                        </a>

                        @if($order->status === 'pending')
                            <form action="{{ route('distributor.orders.cancel', $order) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                                    Cancel Order
                                </button>
                            </form>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
