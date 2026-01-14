<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Start Chat with {{ $user->name }}</h3>
                    
                    <form action="{{ route('chat.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="recipient_id" value="{{ $user->id }}">
                        
                        <div class="mb-4">
                            <label class="block text-sm font-bold mb-2">Message</label>
                            <textarea name="body" rows="4" class="w-full border-gray-300 rounded focus:ring-[#99010A] focus:border-[#99010A]" required></textarea>
                        </div>
                        
                        <button type="submit" class="bg-[#99010A] text-white px-4 py-2 rounded hover:bg-red-800">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
