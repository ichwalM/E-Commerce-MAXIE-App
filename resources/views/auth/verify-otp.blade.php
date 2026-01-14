<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, please verify your email address by entering the 6-digit OTP code we just emailed to you.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification code has been sent to the email address you provided during registration.') }}
        </div>
    @endif
    
    @if (session('error'))
        <div class="mb-4 font-medium text-sm text-red-600">
            {{ session('error') }}
        </div>
    @endif
    
    @if (session('success'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('verification.verify') }}">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">

        <!-- OTP Code -->
        <div>
            <label for="otp" class="block font-medium text-sm text-gray-700">{{ __('Verification Code') }}</label>
            <input id="otp" class="block mt-1 w-full text-center text-2xl tracking-widest border-gray-300 focus:border-[#99010A] focus:ring-[#99010A] rounded-md shadow-sm" type="text" name="otp" required autofocus placeholder="123456" maxlength="6" />
            @error('otp') <span class="text-red-600 text-sm mt-2 block">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.resend') }}" class="inline">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#99010A]">
                    {{ __('Resend Verification Code') }}
                </button>
            </form>

            <button type="submit" class="ml-3 inline-flex items-center px-4 py-2 bg-[#99010A] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-800 focus:bg-red-800 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-[#99010A] focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Verify') }}
            </button>
        </div>
    </form>
</x-guest-layout>
