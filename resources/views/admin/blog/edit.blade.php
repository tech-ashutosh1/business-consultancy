<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                ✏️ Edit Blog Post
            </h2>
            <a href="{{ route('blog.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                ← Back to Posts
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Breadcrumbs --}}
            <x-breadcrumbs :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Blog Posts', 'url' => route('blog.index')],
                ['label' => 'Edit Post', 'url' => '#']
            ]" />

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

                    <form action="{{ route('blog.update', $blog) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div>
                            <label for="title" class="block text-sm font-bold text-gray-700 mb-2">
                                Post Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="title" 
                                   id="title"
                                   value="{{ old('title', $blog->title) }}"
                                   required
                                   class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition outline-none text-lg font-semibold">
                        </div>

                        {{-- Category & Status Row --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Category --}}
                            <div>
                                <label for="category" class="block text-sm font-bold text-gray-700 mb-2">
                                    Category <span class="text-red-500">*</span>
                                </label>
                                <select name="category" 
                                        id="category"
                                        required
                                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition outline-none">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat }}" {{ old('category', $blog->category) == $cat ? 'selected' : '' }}>
                                            {{ $cat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Status --}}
                            <div>
                                <label for="status" class="block text-sm font-bold text-gray-700 mb-2">
                                    Status <span class="text-red-500">*</span>
                                </label>
                                <select name="status" 
                                        id="status"
                                        required
                                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition outline-none">
                                    <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>Published</option>
                                </select>
                            </div>
                        </div>

                        {{-- Excerpt --}}
                        <div>
                            <label for="excerpt" class="block text-sm font-bold text-gray-700 mb-2">
                                Excerpt (Short Summary)
                            </label>
                            <textarea name="excerpt" 
                                      id="excerpt"
                                      rows="3"
                                      class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition outline-none resize-none">{{ old('excerpt', $blog->excerpt) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Optional - Max 500 characters</p>
                        </div>

                        {{-- Content --}}
                        <div>
                            <label for="content" class="block text-sm font-bold text-gray-700 mb-2">
                                Content <span class="text-red-500">*</span>
                            </label>
                            <textarea name="content" 
                                      id="content"
                                      rows="15"
                                      required
                                      class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition outline-none resize-y">{{ old('content', $blog->content) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">💡 Tip: Use line breaks for paragraphs. HTML is supported.</p>
                        </div>

                        {{-- Featured Toggle --}}
                        <div class="bg-yellow-50 border-2 border-yellow-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       name="is_featured" 
                                       id="is_featured"
                                       value="1"
                                       {{ old('is_featured', $blog->is_featured) ? 'checked' : '' }}
                                       class="w-5 h-5 text-yellow-600 border-gray-300 rounded focus:ring-yellow-500">
                                <label for="is_featured" class="ml-3 text-sm font-semibold text-gray-700">
                                    ⭐ Mark as Featured Post
                                </label>
                            </div>
                            <p class="text-xs text-gray-600 mt-2 ml-8">Featured posts appear at the top of the blog page</p>
                        </div>

                        {{-- Buttons --}}
                        <div class="flex items-center justify-between pt-4 border-t">
                            <a href="{{ route('blog.index') }}" 
                               class="text-gray-600 hover:text-gray-800 font-semibold transition">
                                ← Cancel
                            </a>
                            <button type="submit" 
                                    class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                                💾 Update Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>