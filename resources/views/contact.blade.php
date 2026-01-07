@extends('layouts.public')

@section('title', 'Contact Us')

@section('content')
    {{-- Breadcrumbs --}}
    <x-breadcrumbs :items="[
        ['label' => 'Home', 'url' => '/home'],
        ['label' => 'Contact Us', 'url' => '/contact']
    ]" />
    <div class="max-w-4xl mx-auto">
        <div class="mb-10">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 border-b-4 border-indigo-600 inline-block pb-3 mb-4">
                Contact Us
            </h1>
            <p class="text-gray-600 text-lg">
                Have a question or want to discuss how we can help your business? 
                Fill out the form below and we'll get back to you as soon as possible.
            </p>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-lg mb-8 shadow-md animate-pulse">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        {{-- Error Messages --}}
        @if($errors->any())
            <div class="bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-lg mb-8 shadow-md">
                <div class="flex items-start">
                    <svg class="w-6 h-6 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="font-semibold mb-2">Please fix the following errors:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            {{-- Contact Form --}}
            <div class="lg:col-span-3">
                <div class="scroll-reveal bg-white rounded-xl shadow-lg p-8">
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf

                        {{-- Name Field --}}
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Your Name <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name"
                                value="{{ old('name') }}"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition outline-none"
                                placeholder="John Doe"
                            >
                        </div>

                        {{-- Email Field --}}
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email"
                                value="{{ old('email') }}"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition outline-none"
                                placeholder="john@example.com"
                            >
                        </div>

                        {{-- Subject Field --}}
                        <div>
                            <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">
                                Subject <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="subject" 
                                id="subject"
                                value="{{ old('subject') }}"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition outline-none"
                                placeholder="What is this regarding?"
                            >
                        </div>

                        {{-- Message Field --}}
                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                                Message <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                name="message" 
                                id="message"
                                rows="6"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition outline-none resize-none"
                                placeholder="Tell us about your inquiry..."
                            >{{ old('message') }}</textarea>
                        </div>

                        {{-- Submit Button --}}
                        <button 
    type="submit"
    class="btn-submit btn-pulse w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold py-4 px-6 rounded-lg shadow-lg hover:shadow-xl hover:-translate-y-1 transform transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-indigo-300"
>
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Send Message
                            </span>
                        </button>
                    </form>
                </div>
            </div>

            {{-- Contact Information Sidebar --}}
            <div class="lg:col-span-2">
                <div class="scroll-reveal bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl shadow-lg p-8 text-white sticky top-24 animate-[slideInRight_0.8s_ease-out]">
                    <h3 class="text-2xl font-bold mb-6">Get in Touch</h3>
                    
                    <div class="space-y-6">
                        {{-- Email --}}
                        <div class="flex items-start">
                            <div class="bg-white bg-opacity-20 rounded-lg p-3 mr-4 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="font-semibold mb-1">Email</p>
                                <a href="mailto:info@businessconsultancy.com" class="text-indigo-100 hover:text-white transition break-words text-sm">
                                    info@businessconsultancy.com
                                </a>
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div class="flex items-start">
                            <div class="bg-white bg-opacity-20 rounded-lg p-3 mr-4 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="font-semibold mb-1">Phone</p>
                                <a href="tel:+15551234567" class="text-indigo-100 hover:text-white transition text-sm">
                                    +1 (555) 123-4567
                                </a>
                            </div>
                        </div>

                        {{-- Address --}}
                        <div class="flex items-start">
                            <div class="bg-white bg-opacity-20 rounded-lg p-3 mr-4 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="font-semibold mb-1">Office</p>
                                <p class="text-indigo-100 text-sm leading-relaxed">
                                    123 Business Street<br>
                                    Suite 100<br>
                                    City, State 12345
                                </p>
                            </div>
                        </div>

                        {{-- Business Hours --}}
                        <div class="flex items-start">
                            <div class="bg-white bg-opacity-20 rounded-lg p-3 mr-4 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="font-semibold mb-1">Business Hours</p>
                                <p class="text-indigo-100 text-sm leading-relaxed">
                                    Monday - Friday<br>
                                    9:00 AM - 6:00 PM
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Response Time Notice --}}
                    <div class="mt-8 bg-white bg-opacity-10 rounded-lg p-4">
                        <p class="text-sm text-indigo-100 leading-relaxed">
                            <span class="font-semibold">⚡ Quick Response:</span><br>
                            We typically respond within 24 hours during business days.
                        </p>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection