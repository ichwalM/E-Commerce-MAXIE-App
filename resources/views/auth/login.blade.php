<x-guest-layout>
    <div class="flex min-h-[calc(100vh-130px)]"> 
        <!-- Left Side - Image/Brand -->
        <div class="hidden lg:flex lg:w-1/2 bg-[#F9F9F9] relative items-center justify-center overflow-hidden">
             <!-- Background Image or Pattern -->
             <div class="absolute inset-0 bg-cover bg-center opacity-80" style="background-image: url('{{ asset('images/hero.webp') }}');"></div>
             <div class="absolute inset-0 bg-gradient-to-r from-black/30 to-transparent"></div>
             
             <div class="relative z-10 text-white p-12 max-w-lg">
                 <h2 class="text-5xl font-bold mb-6 font-heading leading-tight animate-fade-in-up">Welcome Back</h2>
                 <p class="text-lg opacity-90 animate-fade-in-up" style="animation-delay: 0.1s">Sign in to access your dashboard, track your orders, and manage your account.</p>
             </div>
        </div>

        <!-- Right Side - Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-16 bg-white">
            <div class="w-full max-w-md space-y-8 animate-fade-in-up">
                <div class="text-center lg:text-left">
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">Sign in to your account</h1>
                    <p class="mt-2 text-sm text-gray-600">
                        Or <a href="{{ route('register') }}" class="font-medium text-[#99010A] hover:text-red-800 transition">create a new account</a>
                    </p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="p-4 rounded-md bg-green-50 text-green-700 text-sm">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('success'))
                     <div class="p-4 rounded-md bg-green-50 text-green-700 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                    @csrf
            
                    <div class="space-y-5">
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

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full pl-10 border-gray-300 focus:border-[#99010A] focus:ring-[#99010A] rounded-md sm:text-sm py-3" placeholder="••••••••">
                            </div>
                            @error('password') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-[#99010A] focus:ring-[#99010A] border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-900">{{ __('Remember me') }}</label>
                        </div>

                        <div class="text-sm">
                            <a href="#" class="font-medium text-[#99010A] hover:text-red-800">Forgot your password?</a>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-[#99010A] hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#99010A] transition duration-300 transform hover:-translate-y-0.5 shadow-lg">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <i class="fas fa-arrow-right text-red-300 group-hover:text-white transition"></i>
                            </span>
                            Sign in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
