<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <!-- Chart.js CDN -->


    <div class="space-y-6">
        <!-- Welcome Section -->
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <h3 class="font-bold text-lg mb-2 text-gray-800">Welcome back, {{ Auth::user()->name }}!</h3>
            <p class="text-gray-600">You are logged in as a <strong class="text-[#99010A]">{{ ucfirst(Auth::user()->role) }}</strong>.</p>
            
            @if(Auth::user()->role === 'distributor' && !Auth::user()->is_active)
                <div class="mt-4 bg-yellow-50 text-yellow-800 p-4 rounded border border-yellow-200 flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <span>Your distribution account is currently <strong>pending approval</strong>. Full access will be granted once an administrator reviews your application.</span>
                </div>
            @endif
        </div>

        <!-- Admin Specific Stats & Charts -->
        @if(Auth::user()->role === 'admin' && isset($distributorStats))
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                 <!-- Admin Revenue Card -->
                 <div class="bg-gradient-to-br from-[#99010A] to-[#7A0108] text-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="font-bold text-red-100">Total Admin Revenue</h4>
                        <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center">
                            <i class="fas fa-wallet"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-bold mb-1">Rp {{ number_format($adminRevenue, 0, ',', '.') }}</div>
                    <p class="text-red-200 text-sm">From distributor restock orders</p>
                </div>

                <!-- Distributor Performance Chart -->
                <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h4 class="font-bold text-gray-800 mb-4">Distributor Sales Performance</h4>
                    <canvas id="distributorChart" height="120"></canvas>
                </div>
            </div>

            <!-- Distributor Recapitulation Table -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h4 class="font-bold text-gray-800">Distributor Sales Recapitulation</h4>
                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">Ranked by Revenue</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-500 font-medium">
                            <tr>
                                <th class="px-6 py-3">Distributor Name</th>
                                <th class="px-6 py-3 text-center">Orders Completed</th>
                                <th class="px-6 py-3 text-right">Total Revenue Generated</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($distributorStats as $stat)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $stat['name'] }}</td>
                                    <td class="px-6 py-4 text-center text-gray-600">{{ $stat['order_count'] }}</td>
                                    <td class="px-6 py-4 text-right font-bold text-[#99010A]">
                                        Rp {{ number_format($stat['revenue'], 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-8 text-center text-gray-500">No distributor sales data available yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <script>
                const ctx = document.getElementById('distributorChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: @json($chartDistributorLabels),
                        datasets: [{
                            label: 'Total Sales Revenue (IDR)',
                            data: @json($chartDistributorRevenue),
                            backgroundColor: '#99010A',
                            borderRadius: 4,
                            barThickness: 30
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { color: '#f3f4f6' }
                            },
                            x: {
                                grid: { display: false }
                            }
                        }
                    }
                });
            </script>
        @endif

        <!-- Quick Actions Grid (Original Content) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.stock.index') }}" class="group bg-white p-6 shadow-sm rounded-lg border border-gray-100 hover:border-[#99010A] transition hover:shadow-md">
                    <div class="flex items-center justify-between mb-2">
                        <h4 class="font-bold text-gray-800 group-hover:text-[#99010A] transition">Manage Stock</h4>
                        <div class="p-2 bg-red-50 rounded-lg text-[#99010A]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">Add or update global product stock levels across the system.</p>
                </a>
                <a href="{{ route('admin.distributors.index') }}" class="group bg-white p-6 shadow-sm rounded-lg border border-gray-100 hover:border-[#99010A] transition hover:shadow-md">
                    <div class="flex items-center justify-between mb-2">
                        <h4 class="font-bold text-gray-800 group-hover:text-[#99010A] transition">Approve Distributors</h4>
                        <div class="p-2 bg-red-50 rounded-lg text-[#99010A]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">Review and approve pending distributor applications.</p>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="group bg-white p-6 shadow-sm rounded-lg border border-gray-100 hover:border-[#99010A] transition hover:shadow-md">
                     <div class="flex items-center justify-between mb-2">
                        <h4 class="font-bold text-gray-800 group-hover:text-[#99010A] transition">Incoming Requests</h4>
                        <div class="p-2 bg-red-50 rounded-lg text-[#99010A]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">Process restock orders from your distributors.</p>
                </a>
            @endif

            @if(Auth::user()->role === 'distributor')
                <a href="{{ route('distributor.orders.create') }}" class="group bg-white p-6 shadow-sm rounded-lg border border-gray-100 hover:border-[#99010A] transition hover:shadow-md">
                     <div class="flex items-center justify-between mb-2">
                        <h4 class="font-bold text-gray-800 group-hover:text-[#99010A] transition">Request Stock</h4>
                        <div class="p-2 bg-red-50 rounded-lg text-[#99010A]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">Create a new order to restock your inventory from Admin.</p>
                </a>
                <a href="{{ route('distributor.stock.index') }}" class="group bg-white p-6 shadow-sm rounded-lg border border-gray-100 hover:border-[#99010A] transition hover:shadow-md">
                    <div class="flex items-center justify-between mb-2">
                        <h4 class="font-bold text-gray-800 group-hover:text-[#99010A] transition">My Inventory</h4>
                        <div class="p-2 bg-red-50 rounded-lg text-[#99010A]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">View your current stock levels and product details.</p>
                </a>
                 <a href="{{ route('distributor.sales.index') }}" class="group bg-white p-6 shadow-sm rounded-lg border border-gray-100 hover:border-[#99010A] transition hover:shadow-md">
                    <div class="flex items-center justify-between mb-2">
                        <h4 class="font-bold text-gray-800 group-hover:text-[#99010A] transition">Incoming Sales</h4>
                         <div class="p-2 bg-red-50 rounded-lg text-[#99010A]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">Manage orders and sales from your customers.</p>
                </a>
                 <a href="{{ route('distributor.reports.index') }}" class="group bg-white p-6 shadow-sm rounded-lg border border-gray-100 hover:border-[#99010A] transition hover:shadow-md">
                    <div class="flex items-center justify-between mb-2">
                        <h4 class="font-bold text-gray-800 group-hover:text-[#99010A] transition">Reports</h4>
                        <div class="p-2 bg-red-50 rounded-lg text-[#99010A]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z"></path></svg>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">View your sales performance and revenue reports.</p>
                </a>
            @endif

             @if(Auth::user()->role === 'customer')
                <a href="{{ route('customer.products.index') }}" class="group bg-white p-6 shadow-sm rounded-lg border border-gray-100 hover:border-[#99010A] transition hover:shadow-md">
                    <div class="flex items-center justify-between mb-2">
                        <h4 class="font-bold text-gray-800 group-hover:text-[#99010A] transition">Shop Products</h4>
                         <div class="p-2 bg-red-50 rounded-lg text-[#99010A]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">Browse our catalog and purchase skincare products.</p>
                </a>
                <a href="{{ route('customer.orders.index') }}" class="group bg-white p-6 shadow-sm rounded-lg border border-gray-100 hover:border-[#99010A] transition hover:shadow-md">
                    <div class="flex items-center justify-between mb-2">
                        <h4 class="font-bold text-gray-800 group-hover:text-[#99010A] transition">My Orders</h4>
                         <div class="p-2 bg-red-50 rounded-lg text-[#99010A]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">Track your order status and purchase history.</p>
                </a>
            @endif
        </div>
    </div>
</x-app-layout>
