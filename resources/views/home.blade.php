@extends('layouts.public')

@section('title', 'Home')

@section('content')
<div class="page-content">
    {{-- Hero Section with animation --}}
    <div class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 rounded-xl shadow-2xl mb-10 text-center text-white overflow-hidden animate-[fadeIn_0.8s_ease-out]">
        <div class="px-8 py-20 md:px-16 md:py-28">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-6 drop-shadow-lg animate-[slideInLeft_0.8s_ease-out]">
                Transform Your Business Today
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto leading-relaxed opacity-95 animate-[fadeIn_1s_ease-out_0.3s_both]">
                Expert consulting services to help your business grow, innovate, and succeed in today's competitive market.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-[fadeIn_1s_ease-out_0.6s_both]">
                <a href="/services" class="btn-pulse bg-white text-indigo-600 px-10 py-4 rounded-lg font-bold text-lg shadow-xl hover:shadow-2xl hover:-translate-y-1 transform transition duration-300">
                    View Our Services
                </a>
                <a href="/contact" class="bg-transparent border-2 border-white text-white px-10 py-4 rounded-lg font-bold text-lg hover:bg-white hover:text-indigo-600 transition duration-300">
                    Get in Touch
                </a>
            </div>
        </div>
    </div>

    {{-- Why Choose Us Section with scroll animations --}}
    <div class="bg-white rounded-xl shadow-lg p-8 md:p-12 mb-10 scroll-reveal">
        <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-12">
            Why Choose Us?
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Feature 1 --}}
            <div class="scroll-reveal text-center p-6 rounded-lg hover:shadow-xl transition duration-300 hover:-translate-y-2 transform">
                <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full mx-auto mb-6 flex items-center justify-center text-4xl shadow-lg animate-[bounce_2s_ease-in-out_infinite]">
                    ⭐
                </div>
                <h3 class="text-xl font-bold text-indigo-600 mb-3">Expert Team</h3>
                <p class="text-gray-600 leading-relaxed">
                    Our consultants have decades of combined experience across various industries.
                </p>
            </div>

            {{-- Feature 2 --}}
            <div class="scroll-reveal text-center p-6 rounded-lg hover:shadow-xl transition duration-300 hover:-translate-y-2 transform">
                <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full mx-auto mb-6 flex items-center justify-center text-4xl shadow-lg animate-[bounce_2s_ease-in-out_0.2s_infinite]">
                    📊
                </div>
                <h3 class="text-xl font-bold text-indigo-600 mb-3">Data-Driven Results</h3>
                <p class="text-gray-600 leading-relaxed">
                    We use analytics and insights to drive measurable business outcomes.
                </p>
            </div>

            {{-- Feature 3 --}}
            <div class="scroll-reveal text-center p-6 rounded-lg hover:shadow-xl transition duration-300 hover:-translate-y-2 transform">
                <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full mx-auto mb-6 flex items-center justify-center text-4xl shadow-lg animate-[bounce_2s_ease-in-out_0.4s_infinite]">
                    🤝
                </div>
                <h3 class="text-xl font-bold text-indigo-600 mb-3">Personalized Approach</h3>
                <p class="text-gray-600 leading-relaxed">
                    Every business is unique. We tailor our solutions to your specific needs.
                </p>
            </div>
        </div>
    </div>

    {{-- CTA Section with animation --}}
    <div class="scroll-reveal bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-12 md:p-16 text-center shadow-lg">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
            Ready to Get Started?
        </h2>
        <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
            Contact us today for a free consultation and discover how we can help your business thrive.
        </p>
        <a href="/contact" class="btn-pulse inline-block bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-12 py-4 rounded-lg font-bold text-lg shadow-xl hover:shadow-2xl hover:-translate-y-1 transform transition duration-300">
            Contact Us Now
        </a>
    </div>
</div>
@endsection