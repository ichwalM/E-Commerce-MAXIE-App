<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4 text-[#99010A]">Incoming Orders</h3>
                    
                    @if (session('success'))
                        <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-2 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead>
                                <tr class="bg-[#FEFBEC] text-left">
                                    <th class="py-2 px-4 border-b">Invoice</th>
                                    <th class="py-2 px-4 border-b">Buyer</th>
                                    <th class="py-2 px-4 border-b">Type</th>
                                    <th class="py-2 px-4 border-b">Date</th>
                                    <th class="py-2 px-4 border-b">Status</th>
                                    <th class="py-2 px-4 border-b">Total</th>
                                    <th class="py-2 px-4 border-b">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-2 px-4 border-b font-mono text-sm">{{ $order->invoice_no }}</td>
                                        <td class="py-2 px-4 border-b">{{ $order->buyer->name }}</td>
                                        <td class="py-2 px-4 border-b text-xs uppercase">{{ $order->type }}</td>
                                        <td class="py-2 px-4 border-b">{{ $order->created_at->format('d M Y') }}</td>
                                        <td class="py-2 px-4 border-b">
                                            <span class="px-2 py-1 text-xs rounded-full 
                                                {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="py-2 px-4 border-b font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                        <td class="py-2 px-4 border-b">
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-600 hover:underline text-sm">Manage</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                         @if($orders->isEmpty())
                            <div class="text-center py-8 text-gray-500">No orders found.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
