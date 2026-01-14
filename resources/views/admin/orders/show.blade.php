<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
             <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-[#99010A]">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-[#99010A]">Invoice #{{ $order->invoice_no }}</h2>
                            <p class="text-gray-500">Date: {{ $order->created_at->format('d M Y H:i') }}</p>
                            <p class="mt-2">Buyer: <strong>{{ $order->buyer->name }}</strong> ({{ ucfirst($order->buyer->role) }})</p>
                        </div>
                        <div class="text-right">
                             <span class="px-3 py-1 text-sm rounded-full 
                                {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>

                    @if($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-2">Items</h3>
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-100 text-left text-sm text-gray-600">
                                    <th class="p-2 border-b">Product</th>
                                    <th class="p-2 border-b">Price</th>
                                    <th class="p-2 border-b">Qty</th>
                                    <th class="p-2 border-b">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td class="p-2 border-b">{{ $item->product->name }}</td>
                                        <td class="p-2 border-b">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td class="p-2 border-b">{{ $item->quantity }}</td>
                                        <td class="p-2 border-b font-medium">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="p-2 text-right font-bold">Total</td>
                                    <td class="p-2 font-bold text-[#99010A]">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    @if($order->notes)
                        <div class="mb-6 p-4 bg-gray-50 rounded">
                            <h4 class="font-bold text-sm text-gray-600">Notes:</h4>
                            <p>{{ $order->notes }}</p>
                        </div>
                    @endif

                    <!-- Process Actions -->
                    @if($order->status === 'pending')
                    <div class="flex justify-end gap-4 mt-8 border-t pt-4">
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" onsubmit="return confirm('Reject and Cancel this order?');">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="cancelled">
                            <button type="submit" class="px-4 py-2 border border-gray-300 text-gray-700 rounded hover:bg-gray-100">
                                Reject / Cancel
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" onsubmit="return confirm('Approve and process items? This will deduct stock.');">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" class="px-4 py-2 bg-[#99010A] text-white rounded font-bold hover:bg-red-800 shadow">
                                Approve Order
                            </button>
                        </form>
                    </div>
                    @endif
                    
                    <div class="mt-4">
                        <a href="{{ route('admin.orders.index') }}" class="text-sm text-gray-600 hover:underline">&larr; Back to Orders</a>
                    </div>
                </div>
             </div>
        </div>
    </div>
</x-app-layout>
