<x-guest-layout>
    <div class="flex min-h-[calc(100vh-130px)]"> 
        <!-- Left Side - Image/Brand -->
        <div class="hidden lg:flex lg:w-1/2 bg-[#F9F9F9] relative items-center justify-center overflow-hidden">
             <!-- Background Image or Pattern -->
             <div class="absolute inset-0 bg-cover bg-center opacity-80" style="background-image: url('{{ asset('images/hero.webp') }}');"></div>
             <div class="absolute inset-0 bg-gradient-to-r from-black/30 to-transparent"></div>
             
             <div class="relative z-10 text-white p-12 max-w-lg">
                 <h2 class="text-5xl font-bold mb-6 font-heading leading-tight animate-fade-in-up">Join the Club</h2>
                 <p class="text-lg opacity-90 animate-fade-in-up" style="animation-delay: 0.1s">Create an account to unlock exclusive offers, faster checkout, and personalized skincare recommendations.</p>
             </div>
        </div>

        <!-- Right Side - Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-16 bg-white">
            <div class="w-full max-w-md space-y-8 animate-fade-in-up">
                <div class="text-center lg:text-left">
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">Create Account</h1>
                    <p class="mt-2 text-sm text-gray-600">
                        Already have an account? <a href="{{ route('login') }}" class="font-medium text-[#99010A] hover:text-red-800 transition">Sign in</a>
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6" x-data="{ role: 'customer' }">
                    @csrf
            
                    <div class="space-y-5">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Full Name') }}</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="far fa-user text-gray-400"></i>
                                </div>
                                <input id="name" name="name" type="text" autocomplete="name" required class="block w-full pl-10 border-gray-300 focus:border-[#99010A] focus:ring-[#99010A] rounded-md sm:text-sm py-3" placeholder="John Doe" value="{{ old('name') }}">
                            </div>
                            @error('name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email address') }}</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="far fa-envelope text-gray-400"></i>
                                </div>
                                <input id="email" name="email" type="email" autocomplete="email" required class="block w-full pl-10 border-gray-300 focus:border-[#99010A] focus:ring-[#99010A] rounded-md sm:text-sm py-3" placeholder="you@example.com" value="{{ old('email') }}">
                            </div>
                            @error('email') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <!-- Role -->
                        <div>
                             <label for="role" class="block text-sm font-medium text-gray-700">{{ __('I want to register as') }}</label>
                             <div class="mt-1">
                                 <select id="role" name="role" x-model="role" class="block w-full border-gray-300 focus:border-[#99010A] focus:ring-[#99010A] rounded-md sm:text-sm py-3">
                                     <option value="customer">Customer (Buy Products)</option>
                                     <option value="distributor">Distributor (Sell Products)</option>
                                 </select>
                             </div>
                        </div>

                        <!-- Phone (Distributor Only) -->
                        <div x-show="role === 'distributor'" x-transition style="display: none;">
                            <label for="phone" class="block text-sm font-medium text-gray-700">{{ __('Phone Number') }}</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-phone text-gray-400"></i>
                                </div>
                                <input id="phone" name="phone" type="text" class="block w-full pl-10 border-gray-300 focus:border-[#99010A] focus:ring-[#99010A] rounded-md sm:text-sm py-3" placeholder="+62..." value="{{ old('phone') }}">
                            </div>
                            @error('phone') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input id="password" name="password" type="password" autocomplete="new-password" required class="block w-full pl-10 border-gray-300 focus:border-[#99010A] focus:ring-[#99010A] rounded-md sm:text-sm py-3" placeholder="••••••••">
                            </div>
                            @error('password') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">{{ __('Confirm Password') }}</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input id="password_confirmation" name="password_confirmation" type="password" required class="block w-full pl-10 border-gray-300 focus:border-[#99010A] focus:ring-[#99010A] rounded-md sm:text-sm py-3" placeholder="••••••••">
                            </div>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-[#99010A] hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#99010A] transition duration-300 transform hover:-translate-y-0.5 shadow-lg">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <i class="fas fa-user-plus text-red-300 group-hover:text-white transition"></i>
                            </span>
                            Register Account
                        </button>
                        <p class="mt-4 text-xs text-center text-gray-500">
                             By registering, you agree to Maxie Skincare's <a href="#" class="underline hover:text-black">Terms of Service</a> and <a href="#" class="underline hover:text-black">Privacy Policy</a>.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
