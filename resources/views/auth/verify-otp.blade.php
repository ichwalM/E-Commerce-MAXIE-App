<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-[60vh] py-12 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-2xl border border-gray-100">
            <div class="text-center">
                <div class="mx-auto w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-shield-alt text-[#99010A] text-3xl"></i>
                </div>
                <h2 class="text-3xl font-extrabold text-gray-900 font-heading">Verify Your Email</h2>
                <p class="mt-2 text-sm text-gray-600">
                    We've sent a 6-digit code to <span class="font-bold text-gray-900">{{ $email }}</span>
                </p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="rounded-md bg-green-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">
                                {{ __('A new code has been sent.') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
            
            @if (session('error'))
                <div class="rounded-md bg-red-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-times-circle text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800">
                                {{ session('error') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('verification.verify') }}" class="mt-8 space-y-6">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">

                <div>
                    <label for="otp" class="sr-only">Verification Code</label>
                    <input id="otp" name="otp" type="text" required class="appearance-none rounded-lg relative block w-full px-3 py-4 border border-gray-300 placeholder-gray-400 text-gray-900 text-center text-3xl tracking-[1em] font-bold focus:outline-none focus:ring-[#99010A] focus:border-[#99010A] focus:z-10 sm:text-lg transition" placeholder="------" maxlength="6" autofocus>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-[#99010A] hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#99010A] transition duration-300 button-shadow">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                           <i class="fas fa-check text-red-300 group-hover:text-white transition"></i>
                        </span>
                        Verify Email
                    </button>
                </div>
            </form>
            
            <div class="text-center">
                 <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <p class="text-sm text-gray-600">
                        Didn't receive the code? 
                        <button type="submit" class="font-medium text-[#99010A] hover:text-red-800 transition underline">
                            Resend Code
                        </button>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
