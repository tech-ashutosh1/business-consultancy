<x-app-layout>
    <x-slot name="header">
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            ✏️ Edit Service
        </h2>
        <a href="{{ route('services.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
            ← Back to Services
        </a>
    </div>
</x-slot>

    <div class="py-12">
        {{-- Breadcrumbs --}}
        <x-breadcrumbs :items="[
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Manage Services', 'url' => route('services.index')],
            ['label' => 'Edit Service', 'url' => '#']
        ]" />

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    
                    {{-- Error Messages --}}
                    @if($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-lg mb-6">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <strong class="font-semibold">Please fix the following errors:</strong>
                                    <ul class="mt-2 ml-4 list-disc list-inside">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('services.update', $service) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Icon Picker --}}
                        <div>
                            <label for="icon" class="block text-sm font-bold text-gray-700 mb-2">
                                Service Icon (Emoji)
                            </label>
                            <div class="flex gap-4 items-start">
                                <input type="text" 
                                       name="icon" 
                                       id="icon"
                                       value="{{ old('icon', $service->icon) }}"
                                       maxlength="2"
                                       class="w-20 h-20 text-center text-4xl border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition outline-none"
                                       placeholder="📋">
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600 mb-3">Click an icon to select it:</p>
                                    <div class="grid grid-cols-8 gap-2">
                                        @php
                                        $icons = ['💼', '📊', '💡', '🎯', '📈', '🚀', '⚙️', '🏆', 
                                                  '💰', '🔧', '📱', '💻', '🌐', '📝', '✅', '⭐',
                                                  '🎨', '📞', '✉️', '🏢', '👥', '🤝', '📦', '🔍'];
                                        @endphp
                                        @foreach($icons as $emoji)
                                        <button type="button" 
                                                onclick="document.getElementById('icon').value='{{ $emoji }}'"
                                                class="text-3xl hover:bg-indigo-50 p-2 rounded-lg transition border-2 border-transparent hover:border-indigo-300">
                                            {{ $emoji }}
                                        </button>
                                        @endforeach
                                    </div>
                                    <p class="text-xs text-gray-500 mt-3">💡 Tip: You can also paste any emoji directly into the box above</p>
                                </div>
                            </div>
                        </div>

                        {{-- Title Field --}}
                        <div>
                            <label for="title" class="block text-sm font-bold text-gray-700 mb-2">
                                Service Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="title" 
                                   id="title"
                                   value="{{ old('title', $service->title) }}"
                                   required
                                   class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition outline-none">
                        </div>

                        {{-- Description Field --}}
                        <div>
                            <label for="description" class="block text-sm font-bold text-gray-700 mb-2">
                                Description <span class="text-red-500">*</span>
                            </label>
                            <textarea name="description" 
                                      id="description"
                                      rows="6"
                                      required
                                      class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition outline-none resize-none">{{ old('description', $service->description) }}</textarea>
                        </div>

                        {{-- Pricing Section --}}
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-lg border-2 border-green-200">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                <span class="text-2xl mr-2">💰</span>
                                Pricing Information
                            </h3>
                            
                            <div class="space-y-4">
                                {{-- Price Field --}}
                                <div>
                                    <label for="price" class="block text-sm font-bold text-gray-700 mb-2">
                                        Price (Optional)
                                    </label>
                                    <input type="text" 
                                           name="price" 
                                           id="price"
                                           value="{{ old('price', $service->price) }}"
                                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 transition outline-none"
                                           placeholder="e.g., Starting at $2,500 or Custom Quote">
                                    <p class="text-xs text-gray-600 mt-2">
                                        💡 Examples: "Starting at $1,500", "$2,000 - $5,000", "Contact for Quote", "From $500/month"
                                    </p>
                                </div>

                                {{-- Show Price Toggle --}}
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           name="show_price" 
                                           id="show_price"
                                           value="1"
                                           {{ old('show_price', $service->show_price) ? 'checked' : '' }}
                                           class="w-5 h-5 text-green-600 border-gray-300 rounded focus:ring-green-500">
                                    <label for="show_price" class="ml-3 text-sm font-semibold text-gray-700">
                                        Display price on public website
                                    </label>
                                </div>
                                <p class="text-xs text-gray-600">
                                    Uncheck this if you want to hide pricing information from visitors
                                </p>
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="flex items-center justify-between pt-4 border-t">
                            <a href="{{ route('services.index') }}" 
                               class="text-gray-600 hover:text-gray-800 font-semibold transition">
                                ← Back to Services
                            </a>
                            <button type="submit" 
                                    class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                                Update Service
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>