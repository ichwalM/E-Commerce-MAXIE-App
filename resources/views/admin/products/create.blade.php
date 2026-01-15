<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-xl font-bold mb-6 text-[#99010A]">Add New Product</h2>
                    
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Product Name</label>
                            <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#99010A] focus:border-[#99010A]" required value="{{ old('name') }}">
                             @error('name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Description</label>
                            <textarea name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#99010A] focus:border-[#99010A]">{{ old('description') }}</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Admin Price (Base)</label>
                                <input type="number" name="price_admin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#99010A] focus:border-[#99010A]" required value="{{ old('price_admin') }}">
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Retail Price (Suggested)</label>
                                <input type="number" name="price_retail" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#99010A] focus:border-[#99010A]" required value="{{ old('price_retail') }}">
                            </div>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Initial Stock</label>
                            <input type="number" name="initial_stock" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#99010A] focus:border-[#99010A]" value="{{ old('initial_stock', 0) }}">
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Product Image (Optional)</label>
                            <input type="file" name="image" id="imageInput" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                            
                            <!-- Gemini AI Integration -->
                            <div class="mt-2 flex items-center gap-4">
                                <button type="button" onclick="generateAdContent()" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-blue-600 hover:to-purple-700 active:bg-purple-900 focus:outline-none focus:border-purple-900 focus:ring ring-purple-300 disabled:opacity-25 transition ease-in-out duration-150" id="aiBtn">
                                    <span class="mr-2">✨</span> Generate Description
                                </button>
                                <span id="aiStatus" class="text-sm text-gray-500 hidden">Analyzing image with AI...</span>
                            </div>

                            <!-- AI Result Container -->
                            <div id="aiResult" class="mt-4 p-4 bg-purple-50 rounded-lg border border-purple-100 hidden">
                                <h3 class="font-bold text-purple-800 mb-2">AI Suggestion:</h3>
                                <div class="grid gap-2 text-sm">
                                    <div>
                                        <span class="font-bold">Headline:</span> <span id="aiHeadline" class="text-gray-700"></span>
                                    </div>
                                    <div>
                                        <span class="font-bold">Hashtags:</span> <span id="aiHashtags" class="text-blue-600"></span>
                                    </div>
                                </div>
                                <button type="button" onclick="applyAiContent()" class="mt-3 text-xs text-purple-700 hover:text-purple-900 font-bold underline">
                                    Use in Description
                                </button>
                            </div>
                        </div>

                        <div class="flex justify-end gap-2 mt-6">
                            <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Cancel</a>
                            <button type="submit" class="px-4 py-2 bg-[#99010A] text-white rounded hover:bg-red-800">Save Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function generateAdContent() {
            const fileInput = document.getElementById('imageInput');
            const status = document.getElementById('aiStatus');
            const btn = document.getElementById('aiBtn');
            const resultBox = document.getElementById('aiResult');
            
            if (fileInput.files.length === 0) {
                alert('Please select an image first.');
                return;
            }

            const formData = new FormData();
            formData.append('image', fileInput.files[0]);
            formData.append('_token', '{{ csrf_token() }}');

            status.classList.remove('hidden');
            btn.disabled = true;
            resultBox.classList.add('hidden');

            fetch('{{ route("admin.ai.generate") }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const content = data.data;
                    document.getElementById('aiHeadline').innerText = content.headline;
                    document.getElementById('aiHashtags').innerText = content.hashtags.join(' ');
                    
                    // Store description for later use
                    window.generatedDescription = content.description;
                    
                    resultBox.classList.remove('hidden');
                } else {
                    alert('AI Error: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong. Check console.');
            })
            .finally(() => {
                status.classList.add('hidden');
                btn.disabled = false;
            });
        }

        function applyAiContent() {
            const headline = document.getElementById('aiHeadline').innerText;
            const hashtags = document.getElementById('aiHashtags').innerText;
            const description = window.generatedDescription || '';
            
            const fullText = `${headline}\n\n${description}\n\n${hashtags}`;
            
            const textarea = document.querySelector('textarea[name="description"]');
            textarea.value = fullText;
            textarea.focus();
        }
    </script>
</x-app-layout>
