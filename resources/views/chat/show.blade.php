<x-app-layout>
    <div class="py-12 h-screen flex flex-col">
        <div class="max-w-4xl mx-auto w-full flex-1 flex flex-col sm:px-6 lg:px-8">
             <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col flex-1 h-full">
                <!-- Header -->
                @php
                    $otherParticipant = $conversation->participants->where('user_id', '!=', Auth::id())->first()->user;
                @endphp
                <div class="p-4 border-b bg-[#FEFBEC] flex justify-between items-center">
                    <div>
                        <h2 class="font-bold text-[#99010A]">{{ $otherParticipant->name }}</h2>
                        <p class="text-xs text-gray-600">{{ ucfirst($otherParticipant->role) }}</p>
                    </div>
                    <a href="{{ route('chat.index') }}" class="text-sm text-gray-500 hover:text-gray-800">Back</a>
                </div>

                <!-- Messages -->
                <div class="flex-1 overflow-y-auto p-4 space-y-4" id="messages-container">
                    @foreach($conversation->messages as $message)
                        <div class="flex {{ $message->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[70%] rounded-lg p-3 {{ $message->sender_id === Auth::id() ? 'bg-[#99010A] text-white rounded-br-none' : 'bg-gray-100 text-gray-800 rounded-bl-none' }}">
                                <p class="text-sm">{{ $message->body }}</p>
                                <span class="text-[10px] opacity-75 block text-right mt-1">
                                    {{ $message->created_at->format('H:i') }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Input -->
                <div class="p-4 border-t">
                    <form action="{{ route('chat.store') }}" method="POST" class="flex gap-2">
                        @csrf
                        <input type="hidden" name="recipient_id" value="{{ $otherParticipant->id }}">
                        <input type="text" name="body" placeholder="Type a message..." class="flex-1 border-gray-300 rounded-full focus:ring-[#99010A] focus:border-[#99010A]" required autofocus>
                        <button type="submit" class="bg-[#99010A] text-white px-6 py-2 rounded-full hover:bg-red-800 transition">
                            Send
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Scroll to bottom
        const container = document.getElementById('messages-container');
        container.scrollTop = container.scrollHeight;
    </script>
</x-app-layout>
