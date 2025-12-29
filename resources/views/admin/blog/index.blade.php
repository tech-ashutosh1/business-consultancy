<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                📝 Manage Blog Posts
            </h2>
            <div class="flex gap-3">
                <a href="{{ route('blog.public') }}" 
                   target="_blank"
                   class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                    🌐 View Blog
                </a>
                <a href="{{ route('blog.create') }}" 
                   class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-2 px-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                    ✨ New Post
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Breadcrumbs --}}
            <x-breadcrumbs :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Blog Posts', 'url' => route('blog.index')]
            ]" />

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

                    @if($posts->count() > 0)
                        <div class="space-y-4">
                            @foreach($posts as $post)
                                <div class="border-2 border-gray-200 rounded-xl p-6 hover:border-indigo-300 hover:shadow-lg transition duration-300">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3 mb-2">
                                                <h3 class="text-xl font-bold text-gray-800">{{ $post->title }}</h3>
                                                <span class="{{ $post->status_badge }} px-3 py-1 rounded-full text-xs font-semibold">
                                                    {{ ucfirst($post->status) }}
                                                </span>
                                                @if($post->is_featured)
                                                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">
                                                        ⭐ Featured
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-gray-600 text-sm mb-3">{{ Str::limit($post->excerpt, 150) }}</p>
                                            <div class="flex items-center gap-4 text-xs text-gray-500">
                                                <span>📁 {{ $post->category }}</span>
                                                <span>👤 {{ $post->author->name }}</span>
                                                <span>📅 {{ $post->created_at->format('M d, Y') }}</span>
                                                @if($post->published_at)
                                                    <span>🚀 Published: {{ $post->published_at->format('M d, Y') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex gap-2 ml-4">
                                            <a href="{{ route('blog.edit', $post) }}" 
                                               class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold transition duration-300">
                                                ✏️ Edit
                                            </a>
                                            <form action="{{ route('blog.destroy', $post) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to delete this post?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-semibold transition duration-300">
                                                    🗑️ Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 text-center text-gray-600">
                            <strong>Total Posts:</strong> {{ $posts->count() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="text-6xl mb-4">📝</div>
                            <p class="text-xl text-gray-600 mb-4">No blog posts yet</p>
                            <a href="{{ route('blog.create') }}" 
                               class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg transition">
                                Create Your First Post
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>