<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Profile Information') }}
                    </h2>
                    
                    @if (session('success'))
                        <div class="mt-2 mb-4 font-medium text-sm text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <label for="name" class="block font-medium text-sm text-gray-700">{{ __('Name') }}</label>
                            <input id="name" name="name" type="text" class="mt-1 block w-full border-gray-300 focus:border-[#99010A] focus:ring-[#99010A] rounded-md shadow-sm" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="email" class="block font-medium text-sm text-gray-700">{{ __('Email') }}</label>
                            <input id="email" name="email" type="email" class="mt-1 block w-full border-gray-300 focus:border-[#99010A] focus:ring-[#99010A] rounded-md shadow-sm bg-gray-100" value="{{ old('email', $user->email) }}" disabled />
                            <p class="text-sm text-gray-500 mt-1">Email cannot be changed.</p>
                        </div>

                        @if ($user->role === 'distributor')
                            <div>
                                <label for="phone" class="block font-medium text-sm text-gray-700">{{ __('Phone') }}</label>
                                <input id="phone" name="phone" type="text" class="mt-1 block w-full border-gray-300 focus:border-[#99010A] focus:ring-[#99010A] rounded-md shadow-sm" value="{{ old('phone', $user->distributorProfile->phone ?? '') }}" />
                            </div>

                            <div>
                                <label for="address" class="block font-medium text-sm text-gray-700">{{ __('Address') }}</label>
                                <textarea id="address" name="address" class="mt-1 block w-full border-gray-300 focus:border-[#99010A] focus:ring-[#99010A] rounded-md shadow-sm">{{ old('address', $user->distributorProfile->address ?? '') }}</textarea>
                            </div>

                             <div>
                                <label for="nik" class="block font-medium text-sm text-gray-700">{{ __('NIK') }}</label>
                                <input id="nik" name="nik" type="text" class="mt-1 block w-full border-gray-300 focus:border-[#99010A] focus:ring-[#99010A] rounded-md shadow-sm" value="{{ old('nik', $user->distributorProfile->nik ?? '') }}" />
                            </div>

                             <div>
                                <label for="birth_date" class="block font-medium text-sm text-gray-700">{{ __('Birth Date') }}</label>
                                <input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full border-gray-300 focus:border-[#99010A] focus:ring-[#99010A] rounded-md shadow-sm" value="{{ old('birth_date', optional($user->distributorProfile->birth_date ?? null)->format('Y-m-d') ?? '') }}" />
                            </div>
                        @endif

                        <div class="flex items-center gap-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#99010A] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-800 focus:bg-red-800 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-[#99010A] focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
