<x-app-layout>
    <x-slot name="header">
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            💬 Manage Testimonials
        </h2>
        <div class="flex gap-3">
            <a href="{{ route('dashboard') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                ← Back to Dashboard
            </a>
            <a href="{{ route('testimonials.create') }}" 
               class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-2 px-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                ✨ Add New Testimonial
            </a>
        </div>
    </div>
</x-slot>

    <div class="py-12">
        {{-- Breadcrumbs --}}
        <x-breadcrumbs :items="[
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Manage Testimonials', 'url' => route('testimonials.index')]
        ]" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-lg mb-6 shadow-md animate-pulse">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="font-semibold">{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    @if($testimonials->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($testimonials as $testimonial)
                                <div class="bg-gradient-to-br from-gray-50 to-white border-2 border-gray-200 rounded-xl p-6 hover:shadow-xl hover:border-indigo-300 transition duration-300 transform hover:-translate-y-1">
                                    {{-- Rating --}}
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="text-yellow-400 text-xl">
                                            @for($i = 0; $i < $testimonial->rating; $i++)
                                                ★
                                            @endfor
                                            @for($i = $testimonial->rating; $i < 5; $i++)
                                                <span class="text-gray-300">★</span>
                                            @endfor
                                        </div>
                                        <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                                            ID: {{ $testimonial->id }}
                                        </span>
                                    </div>

                                    {{-- Client Info --}}
                                    <div class="flex items-center mb-4">
                                        @if($testimonial->image)
                                            <img src="{{ $testimonial->image }}" alt="{{ $testimonial->name }}" class="w-12 h-12 rounded-full object-cover mr-3 border-2 border-indigo-100">
                                        @else
                                            <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xl mr-3">
                                                {{ substr($testimonial->name, 0, 1) }}
                                            </div>
                                        @endif
                                        <div>
                                            <h3 class="text-lg font-bold text-gray-800 leading-tight">
                                                {{ $testimonial->name }}
                                            </h3>
                                            <p class="text-sm text-gray-600">
                                                {{ $testimonial->position }}
                                                @if($testimonial->company)
                                                    at <span class="text-indigo-600">{{ $testimonial->company }}</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Content --}}
                                    <div class="relative">
                                        <span class="absolute top-0 left-0 text-4xl text-indigo-200 font-serif leading-none -mt-2">“</span>
                                        <p class="text-gray-600 text-sm mb-4 line-clamp-4 pl-6 italic relative z-10">
                                            {{ Str::limit($testimonial->content, 150) }}
                                        </p>
                                    </div>

                                    {{-- Meta Info --}}
                                    <div class="text-xs text-gray-500 mb-4 pb-4 border-b border-gray-200">
                                        <p>Created: {{ $testimonial->created_at->format('M d, Y') }}</p>
                                    </div>

                                    {{-- Actions --}}
                                    <div class="flex gap-3">
                                        <a href="{{ route('testimonials.edit', $testimonial) }}" 
                                           class="flex-1 bg-indigo-500 hover:bg-indigo-600 text-white text-center py-2 px-4 rounded-lg font-semibold transition duration-300 flex items-center justify-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('testimonials.destroy', $testimonial) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this testimonial?');"
                                              class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="w-full bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg font-semibold transition duration-300 flex items-center justify-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 text-center text-gray-600">
                            <strong>Total Testimonials:</strong> {{ $testimonials->count() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="text-6xl mb-4">💬</div>
                            <p class="text-xl text-gray-600 mb-4">No testimonials yet</p>
                            <a href="{{ route('testimonials.create') }}" 
                               class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg transition">
                                Create Your First Testimonial
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
