<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Distributors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4 text-[#99010A]">Distributor List</h3>
                    
                     @if (session('success'))
                        <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-2 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead>
                                <tr class="bg-[#FEFBEC] text-left">
                                    <th class="py-2 px-4 border-b">Name</th>
                                    <th class="py-2 px-4 border-b">Email</th>
                                    <th class="py-2 px-4 border-b">Status</th>
                                    <th class="py-2 px-4 border-b">Joined Date</th>
                                    <th class="py-2 px-4 border-b">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($distributors as $distributor)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-2 px-4 border-b">{{ $distributor->name }}</td>
                                        <td class="py-2 px-4 border-b">{{ $distributor->email }}</td>
                                        <td class="py-2 px-4 border-b">
                                            @if($distributor->is_active)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Active
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-2 px-4 border-b">{{ $distributor->created_at->format('d M Y') }}</td>
                                        <td class="py-2 px-4 border-b">
                                            @if(!$distributor->is_active)
                                                <div class="flex gap-2">
                                                    <form action="{{ route('admin.distributors.approve', $distributor->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="text-white bg-green-600 hover:bg-green-700 px-3 py-1 rounded text-sm transition">
                                                            Approve
                                                        </button>
                                                    </form>
                                                    
                                                    <form action="{{ route('admin.distributors.reject', $distributor->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to reject and remove this application?');">
                                                        @csrf
                                                        <button type="submit" class="text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-sm transition">
                                                            Reject
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <div class="flex items-center gap-2">
                                                    <span class="text-green-600 font-semibold text-sm">Approved</span>
                                                    <form action="{{ route('admin.distributors.deactivate', $distributor->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to deactivate this distributor?');">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="text-white bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded text-xs transition">
                                                            Deactivate
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
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
