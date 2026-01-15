<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Message') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="GET" action="{{ route('chat.new') }}" class="mb-6 flex gap-2">
                        <input type="text" name="search" value="{{ $query ?? '' }}" placeholder="Search by name..." class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-[#99010A] focus:ring-[#99010A]">
                        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-black transition">
                            Search
                        </button>
                    </form>

                    <h3 class="font-bold mb-4 text-[#99010A]">Suggested Contacts</h3>
                    <div class="space-y-4">
                        @foreach($users as $user)
                            <div class="flex items-center justify-between border p-4 rounded-lg hover:bg-gray-50 transition">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-[#99010A] text-white flex items-center justify-center font-bold">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="font-bold">{{ $user->name }}</h4>
                                        <p class="text-xs text-gray-500">{{ ucfirst($user->role) }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('chat.create', $user->id) }}" class="bg-[#99010A] text-white px-4 py-2 rounded hover:bg-red-800 transition text-sm">
                                    Start Chat
                                </a>
                            </div>
                        @endforeach
                        
                        @if($users->isEmpty())
                            <div class="text-center py-8 text-gray-500">
                                No users found.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
