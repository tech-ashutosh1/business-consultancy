@extends('layouts.public')

@section('title', 'About Us')

@section('content')
  {{-- Breadcrumbs --}}
    <x-breadcrumbs :items="[
        ['label' => 'Home', 'url' => '/home'],
        ['label' => 'About Us', 'url' => '/about']
    ]" />

    {{-- Hero Section --}}
    <div class="bg-gradient-to-br from-indigo-600 via-purple-600 to-indigo-800 rounded-2xl shadow-2xl p-8 md:p-16 mb-8 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-white opacity-5 rounded-full -ml-48 -mb-48"></div>
        
        <div class="relative z-10">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                Transforming Businesses,<br/>
                <span class="text-indigo-200">Empowering Success</span>
            </h1>
            <p class="text-xl md:text-2xl text-indigo-100 max-w-3xl">
                Since 2020, we've been partnering with forward-thinking companies to unlock their full potential through strategic innovation and excellence.
            </p>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="grid md:grid-cols-3 gap-8 mb-8">
        {{-- Story Section --}}
        <div class="md:col-span-2 bg-white rounded-xl shadow-lg p-8 md:p-10">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center">
                <span class="w-12 h-1 bg-indigo-600 mr-4"></span>
                Our Story
            </h2>
            
            <div class="space-y-6">
                <p class="text-gray-700 text-lg leading-relaxed">
                    Founded in 2020, we emerged from a simple yet powerful vision: to bridge the gap between business ambition and achievement. Our team of experienced professionals brings together diverse expertise across strategy, finance, operations, and technology, creating a holistic approach to business transformation.
                </p>
                
                <p class="text-gray-700 text-lg leading-relaxed">
                    What started as a small consultancy has grown into a trusted partner for businesses across industries. We've helped over 200 companies navigate complex challenges, implement innovative solutions, and achieve measurable results that exceed expectations.
                </p>

                <p class="text-gray-700 text-lg leading-relaxed">
                    Our mission is to provide strategic insights and actionable solutions that drive sustainable growth and competitive advantage. We believe in building long-term partnerships with our clients, working collaboratively to overcome challenges and seize opportunities in today's dynamic business environment.
                </p>
            </div>

            {{-- Stats Section --}}
            <div class="grid grid-cols-3 gap-6 mt-10 pt-8 border-t border-gray-200">
                <div class="text-center">
                    <div class="text-4xl font-bold text-indigo-600 mb-2">200+</div>
                    <div class="text-gray-600 font-medium">Clients Served</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-indigo-600 mb-2">50+</div>
                    <div class="text-gray-600 font-medium">Expert Consultants</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-indigo-600 mb-2">98%</div>
                    <div class="text-gray-600 font-medium">Client Satisfaction</div>
                </div>
            </div>
        </div>

        {{-- Mission & Vision Sidebar --}}
        <div class="space-y-6">
            <div class="bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-xl shadow-lg p-8 text-white">
                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Our Mission</h3>
                <p class="text-indigo-100 leading-relaxed">
                    To empower businesses with strategic insights and innovative solutions that drive sustainable growth and lasting success.
                </p>
            </div>

            <div class="bg-gradient-to-br from-purple-600 to-purple-700 rounded-xl shadow-lg p-8 text-white">
                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Our Vision</h3>
                <p class="text-purple-100 leading-relaxed">
                    To be the most trusted consultancy partner, recognized for transforming challenges into opportunities worldwide.
                </p>
            </div>
        </div>
    </div>

    {{-- Values Section --}}
    <div class="bg-white rounded-xl shadow-lg p-8 md:p-10 mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 flex items-center">
            <span class="w-12 h-1 bg-indigo-600 mr-4"></span>
            Our Core Values
        </h2>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="group bg-gradient-to-br from-indigo-50 to-indigo-100 hover:from-indigo-100 hover:to-indigo-200 rounded-xl p-6 transition-all duration-300 border border-indigo-200">
                <div class="flex items-start">
                    <div class="w-12 h-12 bg-indigo-600 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-indigo-900 mb-2">Excellence</h3>
                        <p class="text-gray-700 leading-relaxed">
                            We strive for the highest standards in everything we do, delivering exceptional results that exceed expectations and set new benchmarks for quality.
                        </p>
                    </div>
                </div>
            </div>

            <div class="group bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 rounded-xl p-6 transition-all duration-300 border border-purple-200">
                <div class="flex items-start">
                    <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-purple-900 mb-2">Integrity</h3>
                        <p class="text-gray-700 leading-relaxed">
                            We operate with unwavering honesty and transparency, building trust through ethical practices and authentic relationships with our clients.
                        </p>
                    </div>
                </div>
            </div>

            <div class="group bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 rounded-xl p-6 transition-all duration-300 border border-blue-200">
                <div class="flex items-start">
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-blue-900 mb-2">Innovation</h3>
                        <p class="text-gray-700 leading-relaxed">
                            We embrace new ideas and creative solutions, constantly pushing boundaries to deliver cutting-edge strategies that drive business transformation.
                        </p>
                    </div>
                </div>
            </div>

            <div class="group bg-gradient-to-br from-pink-50 to-pink-100 hover:from-pink-100 hover:to-pink-200 rounded-xl p-6 transition-all duration-300 border border-pink-200">
                <div class="flex items-start">
                    <div class="w-12 h-12 bg-pink-600 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-pink-900 mb-2">Partnership</h3>
                        <p class="text-gray-700 leading-relaxed">
                            We build lasting relationships with our clients, working as collaborative partners invested in your long-term success and growth.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Call to Action --}}
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl shadow-2xl p-8 md:p-12 text-center text-white">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Transform Your Business?</h2>
        <p class="text-xl text-indigo-100 mb-8 max-w-2xl mx-auto">
            Let's discuss how our expertise can help you achieve your strategic goals and drive sustainable growth.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/contact" class="bg-white text-indigo-600 px-8 py-4 rounded-lg font-semibold hover:bg-indigo-50 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-1 duration-200">
                Get In Touch
            </a>
            <a href="/services" class="bg-indigo-700 text-white px-8 py-4 rounded-lg font-semibold hover:bg-indigo-800 transition-colors border-2 border-white border-opacity-30 hover:border-opacity-50 transform hover:-translate-y-1 duration-200">
                Explore Services
            </a>
        </div>
    </div>
@endsection