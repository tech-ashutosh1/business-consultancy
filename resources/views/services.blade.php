@extends('layouts.public')

@section('title', 'Our Services')

@section('content')
{{-- Breadcrumbs --}}
    <x-breadcrumbs :items="[
        ['label' => 'Home', 'url' => '/home'],
        ['label' => 'Services', 'url' => '/services']
    ]" />
    <div class="mb-10">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 border-b-4 border-indigo-600 inline-block pb-3 mb-8">
            Our Consulting Services
        </h1>
        <p class="text-gray-600 text-lg">Comprehensive solutions tailored to your business needs</p>
    </div>
    
    @if($services->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($services as $service)
                <div class="scroll-reveal bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden group transform hover:-translate-y-2 hover:scale-105">
                    <div class="p-8">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h2 class="text-2xl font-bold text-indigo-600 group-hover:text-purple-600 transition duration-300">
                                    {{ $service->title }}
                                </h2>
                                {{-- Price Badge --}}
                                @if($service->price && $service->show_price)
                                    <div class="mt-3 animate-[slideInLeft_0.5s_ease-out]">
                                        <span class="inline-flex items-center bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 px-4 py-2 rounded-full text-sm font-bold shadow-sm hover:shadow-md transition duration-300">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $service->price }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="text-5xl ml-4 group-hover:scale-110 transition-transform duration-300">
                                {{ $service->icon ?: '🎯' }}
                            </div>
                        </div>
                        <p class="text-gray-700 leading-relaxed mb-6">
                            {{ $service->description }}
                        </p>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <a href="/contact" class="btn-pulse inline-flex items-center text-indigo-600 hover:text-purple-600 font-semibold transition group">
                                Get Started
                                <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                            @if(!$service->price || !$service->show_price)
                                <span class="text-sm text-gray-500 italic">Contact for pricing</span>
                            @endif
                        </div>
                    </div>
                    <div class="h-2 bg-gradient-to-r from-indigo-600 to-purple-600 group-hover:h-3 transition-all duration-300"></div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-gray-100 border-l-4 border-indigo-600 text-gray-700 p-6 rounded">
            <p class="font-semibold">No services available at the moment.</p>
            <p class="text-sm mt-2">Please check back later or contact us for more information.</p>
        </div>
    @endif

    {{-- CTA Section --}}
    <div class="mt-16 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl p-10 text-center text-white shadow-xl">
        <h2 class="text-3xl font-bold mb-4">Need a Custom Solution?</h2>
        <p class="text-lg mb-6 opacity-90">We can tailor our services to meet your specific business requirements.</p>
        <a href="/contact" class="inline-block bg-white text-indigo-600 px-8 py-3 rounded-lg font-bold hover:shadow-xl transform hover:-translate-y-1 transition duration-300">
            Get in Touch
        </a>
    </div>
@endsection