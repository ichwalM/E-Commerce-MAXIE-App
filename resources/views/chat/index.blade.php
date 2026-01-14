<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4 text-[#99010A]">Conversations</h3>
                    
                    <div class="space-y-4">
                        @foreach($conversations as $conversation)
                            @php
                                $otherParticipant = $conversation->participants->where('user_id', '!=', Auth::id())->first()->user;
                                $lastMessage = $conversation->messages->first();
                            @endphp
                            <a href="{{ route('chat.show', $conversation->id) }}" class="block border rounded-lg p-4 hover:bg-gray-50 transition">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h4 class="font-bold text-gray-900">{{ $otherParticipant->name }}</h4>
                                        <p class="text-xs text-gray-500">{{ ucfirst($otherParticipant->role) }}</p>
                                    </div>
                                    <span class="text-xs text-gray-400">
                                        {{ $conversation->updated_at->diffForHumans() }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 mt-2 truncate">
                                    {{ $lastMessage ? $lastMessage->body : 'No messages yet.' }}
                                </p>
                            </a>
                        @endforeach

                        @if($conversations->isEmpty())
                            <div class="text-center py-8 text-gray-500">
                                No conversations yet.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
