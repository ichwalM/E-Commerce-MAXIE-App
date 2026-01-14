<x-guest-layout>
    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 overflow-hidden bg-white">
        <!-- Background Elements -->
        <div class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-bl from-red-50/50 to-transparent pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-1/4 h-64 bg-gradient-to-tr from-gray-50 to-transparent pointer-events-none"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-4xl mx-auto text-center" x-data>
                <span class="inline-block py-1 px-3 rounded-full bg-red-50 text-[#99010A] text-xs font-semibold tracking-wide uppercase mb-6 reveal-hidden" x-intersect="$el.classList.add('reveal-visible')">
                    About Maxie Skincare
                </span>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight font-serif reveal-hidden delay-100" x-intersect="$el.classList.add('reveal-visible')">
                    Redefining Beauty Through <br> <span class="text-[#99010A]">Active Innovation</span>
                </h1>
                <p class="text-lg text-gray-600 mb-10 leading-relaxed max-w-2xl mx-auto reveal-hidden delay-200" x-intersect="$el.classList.add('reveal-visible')">
                    Maxie Skincare was born from a passion to deliver premium, effective, and safe skincare solutions accessible to everyone. We believe confidence starts with healthy, glowing skin.
                </p>
            </div>
        </div>
    </section>

    <!-- Our Story Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center gap-12 lg:gap-20">
                <div class="w-full md:w-1/2" x-data>
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl reveal-hidden" x-intersect="$el.classList.add('reveal-visible')">
                        <!-- Placeholder for About Image - Using a gradient for now -->
                        <div class="aspect-[4/5] bg-gradient-to-br from-gray-200 to-gray-300 w-full object-cover">
                             <div class="absolute inset-0 flex items-center justify-center text-gray-400">
                                <img src="{{ asset('images/hero2.webp') }}" alt="About Us" class="w-full h-full object-cover transform hover:scale-105 transition duration-700">
                             </div>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2" x-data>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6 font-serif reveal-hidden" x-intersect="$el.classList.add('reveal-visible')">The Maxie Philosophy</h2>
                    <div class="space-y-6 text-gray-600 leading-relaxed reveal-hidden delay-100" x-intersect="$el.classList.add('reveal-visible')">
                        <p>
                            Founded in 2024, our journey began with a simple question: "Why should premium effective ingredients be a luxury?" We set out to challenge the status quo by formulating high-performance skincare that combines nature's best with clinical science.
                        </p>
                        <p>
                            At Maxie, we don't just sell products; we offer a transformation. Every serum, cream, and toner is rigorously tested (and BPOM certified) to ensure it delivers real, visible results without compromising on safety.
                        </p>
                        <p>
                            We are more than a brand; we are a community of beauty enthusiasts, distributors, and dreamers who believe that everyone deserves to shine.
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-6 mt-10 reveal-hidden delay-200" x-intersect="$el.classList.add('reveal-visible')">
                        <div class="p-6 bg-red-50 rounded-xl border border-red-100 transition hover:-translate-y-1 hover:shadow-md">
                            <h3 class="text-2xl font-bold text-[#99010A] mb-1">10k+</h3>
                            <p class="text-sm text-gray-600">Happy Customers</p>
                        </div>
                        <div class="p-6 bg-red-50 rounded-xl border border-red-100 transition hover:-translate-y-1 hover:shadow-md">
                            <h3 class="text-2xl font-bold text-[#99010A] mb-1">50+</h3>
                            <p class="text-sm text-gray-600">Active Distributors</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision & Mission -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12" x-data>
                <!-- Vision -->
                <div class="bg-white p-10 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition duration-300 group reveal-hidden delay-100" x-intersect="$el.classList.add('reveal-visible')">
                    <div class="w-12 h-12 bg-red-50 text-[#99010A] rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Our Vision</h3>
                    <p class="text-gray-600 leading-relaxed">
                        To become Indonesia's leading skincare brand known for integrity, innovation, and empowering individuals to achieve financial independence through our partnership programs.
                    </p>
                </div>

                <!-- Mission -->
                <div class="bg-white p-10 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition duration-300 group reveal-hidden delay-200" x-intersect="$el.classList.add('reveal-visible')">
                    <div class="w-12 h-12 bg-red-50 text-[#99010A] rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Our Mission</h3>
                    <ul class="text-gray-600 leading-relaxed space-y-3">
                        <li class="flex items-start">
                            <span class="mr-2 text-[#99010A]">•</span> Produce high-quality, safe, and effective skincare products.
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2 text-[#99010A]">•</span> Continuously innovate based on the latest dermatological research.
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2 text-[#99010A]">•</span> Build a supportive community for our distributors to grow and succeed.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-12 font-serif" x-data x-intersect="$el.classList.add('animate-fade-in-up')">Why Choose Maxie?</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8" x-data>
                <div class="p-6 reveal-hidden delay-100" x-intersect="$el.classList.add('reveal-visible')">
                    <div class="mx-auto w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-6 text-[#99010A] hover:bg-[#99010A] hover:text-white transition duration-300">
                         <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">BPOM Certified</h3>
                    <p class="text-gray-600 text-sm">All our products are rigorously tested and certified safe for use.</p>
                </div>
                <div class="p-6 reveal-hidden delay-200" x-intersect="$el.classList.add('reveal-visible')">
                    <div class="mx-auto w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-6 text-[#99010A] hover:bg-[#99010A] hover:text-white transition duration-300">
                         <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Premium Ingredients</h3>
                    <p class="text-gray-600 text-sm">We use top-tier active ingredients like Niacinamide and Alpha Arbutin.</p>
                </div>
                <div class="p-6 reveal-hidden delay-300" x-intersect="$el.classList.add('reveal-visible')">
                    <div class="mx-auto w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-6 text-[#99010A] hover:bg-[#99010A] hover:text-white transition duration-300">
                         <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Community First</h3>
                    <p class="text-gray-600 text-sm">Our business model is designed to help our partners grow financially.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA -->
    <section class="py-20 bg-[#99010A] text-white">
        <div class="container mx-auto px-6 text-center" x-data>
            <h2 class="text-3xl md:text-4xl font-bold mb-6 reveal-hidden" x-intersect="$el.classList.add('reveal-visible')">Ready to Glow with Us?</h2>
            <p class="text-red-100 mb-8 max-w-xl mx-auto text-lg reveal-hidden delay-100" x-intersect="$el.classList.add('reveal-visible')">Join thousands of others who have transformed their skin and their lives with Maxie Skincare.</p>
            <div class="flex justify-center gap-4 reveal-hidden delay-200" x-intersect="$el.classList.add('reveal-visible')">
                <a href="{{ route('customer.products.index') }}" class="px-8 py-3 bg-white text-[#99010A] font-bold rounded-lg hover:bg-red-50 transition shadow-lg hover:-translate-y-1">
                    Shop Now
                </a>
                <a href="{{ route('register') }}" class="px-8 py-3 bg-transparent border border-white text-white font-bold rounded-lg hover:bg-white/10 transition hover:-translate-y-1">
                    Join as Partner
                </a>
            </div>
        </div>
    </section>
</x-guest-layout>
