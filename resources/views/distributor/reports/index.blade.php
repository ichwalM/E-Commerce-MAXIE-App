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
                    
                    <!-- Filter Section -->
                    <form method="GET" action="{{ route('distributor.reports.index') }}" class="mb-8 p-4 bg-gray-50 rounded-lg border border-gray-200 flex flex-wrap gap-4 items-end">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Start Date</label>
                            <input type="date" name="start_date" value="{{ $startDate }}" class="rounded-md border-gray-300 shadow-sm focus:border-[#99010A] focus:ring-[#99010A]">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">End Date</label>
                            <input type="date" name="end_date" value="{{ $endDate }}" class="rounded-md border-gray-300 shadow-sm focus:border-[#99010A] focus:ring-[#99010A]">
                        </div>
                        <div class="flex gap-2">
                             <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-black transition">
                                Filter Report
                             </button>
                             <a href="{{ route('distributor.reports.export', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition flex items-center gap-2">
                                <i class="fas fa-file-excel"></i> Export Excel
                             </a>
                        </div>
                    </form>

                    <div class="flex justify-between items-center mb-6">
                         <h3 class="text-lg font-bold text-[#99010A]">Performance Overview</h3>
                         <span class="text-sm text-gray-500">Period: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</span>
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

                    <h3 class="text-lg font-bold mb-4">Detailed Sales History</h3>
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
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="py-2 px-4 border-b font-mono text-sm">{{ $sale->invoice_no }}</td>
                                        <td class="py-2 px-4 border-b">{{ $sale->created_at->format('d M Y H:i') }}</td>
                                        <td class="py-2 px-4 border-b">
                                            <div class="font-bold">{{ $sale->buyer->name }}</div>
                                            <div class="text-xs text-gray-500">{{ ucfirst($sale->buyer->role) }}</div>
                                        </td>
                                        <td class="py-2 px-4 border-b font-bold text-[#99010A]">Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($recentSales->isEmpty())
                            <div class="text-center py-12 bg-gray-50 border border-t-0 border-gray-300 rounded-b-lg">
                                <p class="text-gray-500">No sales records found for this period.</p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
