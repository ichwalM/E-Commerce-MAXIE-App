<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block font-medium text-sm text-gray-700">{{ __('Name') }}</label>
            <input id="name" class="block mt-1 w-full border-gray-300 focus:border-[#99010A] focus:ring-[#99010A] rounded-md shadow-sm" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email" class="block font-medium text-sm text-gray-700">{{ __('Email') }}</label>
            <input id="email" class="block mt-1 w-full border-gray-300 focus:border-[#99010A] focus:ring-[#99010A] rounded-md shadow-sm" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
             @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Phone (for Distributors) -->
        <div class="mt-4" x-data="{ role: 'customer' }">
            <div class="mb-4">
                 <label for="role" class="block font-medium text-sm text-gray-700">{{ __('Role') }}</label>
                 <select id="role" name="role" x-model="role" class="block mt-1 w-full border-gray-300 focus:border-[#99010A] focus:ring-[#99010A] rounded-md shadow-sm">
                     <option value="customer">Customer</option>
                     <option value="distributor">Distributor</option>
                 </select>
            </div>

            <div x-show="role === 'distributor'" style="display: none;">
                <label for="phone" class="block font-medium text-sm text-gray-700">{{ __('Phone Number') }}</label>
                <input id="phone" class="block mt-1 w-full border-gray-300 focus:border-[#99010A] focus:ring-[#99010A] rounded-md shadow-sm" type="text" name="phone" value="{{ old('phone') }}" />
                @error('phone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block font-medium text-sm text-gray-700">{{ __('Password') }}</label>
            <input id="password" class="block mt-1 w-full border-gray-300 focus:border-[#99010A] focus:ring-[#99010A] rounded-md shadow-sm" type="password" name="password" required autocomplete="new-password" />
            @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-[#99010A] focus:ring-[#99010A] rounded-md shadow-sm" type="password" name="password_confirmation" required autocomplete="new-password" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#99010A]" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-[#99010A] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-800 focus:bg-red-800 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-[#99010A] focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</x-guest-layout>
