<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sales Report') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                         <h3 class="text-lg font-bold text-[#99010A]">Performance Overview</h3>
                         <a href="{{ route('distributor.reports.export') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                             Download CSV
                         </a>
                    </div>
                   
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-[#FEFBEC] p-6 rounded-lg border border-[#99010A]/20">
                            <h4 class="text-sm text-gray-500 uppercase font-bold">Total Revenue</h4>
                            <p class="text-3xl font-bold text-[#99010A] mt-2">
                                Rp {{ number_format($salesStats->total_revenue ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="bg-blue-50 p-6 rounded-lg border border-blue-200">
                            <h4 class="text-sm text-blue-500 uppercase font-bold">Total Orders Completed</h4>
                            <p class="text-3xl font-bold text-blue-800 mt-2">
                                {{ $salesStats->total_orders ?? 0 }}
                            </p>
                        </div>
                    </div>

                    <h3 class="text-lg font-bold mb-4">Recent Sales</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100 text-left">
                                    <th class="py-2 px-4 border-b">Invoice</th>
                                    <th class="py-2 px-4 border-b">Date</th>
                                    <th class="py-2 px-4 border-b">Customer</th>
                                    <th class="py-2 px-4 border-b">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentSales as $sale)
                                    <tr>
                                        <td class="py-2 px-4 border-b font-mono text-sm">{{ $sale->invoice_no }}</td>
                                        <td class="py-2 px-4 border-b">{{ $sale->created_at->format('d M Y') }}</td>
                                        <td class="py-2 px-4 border-b">{{ $sale->buyer->name }}</td>
                                        <td class="py-2 px-4 border-b font-bold">Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($recentSales->isEmpty())
                            <div class="text-center py-4 text-gray-500">No completed sales yet.</div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
