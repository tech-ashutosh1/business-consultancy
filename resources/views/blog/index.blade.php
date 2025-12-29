@extends('layouts.public')

@section('title', 'Blog & News')

@section('content')
<div class="page-content">
    {{-- Breadcrumbs --}}
    <x-breadcrumbs :items="[
        ['label' => 'Home', 'url' => '/home'],
        ['label' => 'Blog', 'url' => route('blog.public')]
    ]" />

    {{-- Header --}}
    <div class="mb-10 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 border-b-4 border-indigo-600 inline-block pb-3 mb-4">
            Blog & News
        </h1>
        <p class="text-gray-600 text-lg">Stay updated with our latest insights and company news</p>
    </div>

    {{-- Featured Posts --}}
    @if($featuredPosts->count() > 0)
        <div class="mb-16">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <span class="text-3xl mr-3">⭐</span>
                Featured Posts
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-{{ min(3, $featuredPosts->count()) }} gap-6">
                @foreach($featuredPosts as $post)
                    <div class="scroll-reveal bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-2">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-xs font-bold">
                                    ⭐ FEATURED
                                </span>
                                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ $post->category }}
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-indigo-600 transition">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($post->excerpt, 120) }}</p>
                            <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                                <span>{{ $post->published_at->format('M d, Y') }}</span>
                                <span>{{ $post->reading_time }}</span>
                            </div>
                            <a href="{{ route('blog.show', $post->slug) }}" 
                               class="inline-flex items-center text-indigo-600 hover:text-purple-600 font-semibold transition group">
                                Read More
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="h-1 bg-gradient-to-r from-indigo-600 to-purple-600"></div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- All Posts --}}
    <div>
        <h2 class="text-2xl font-bold text-gray-800 mb-6">All Posts</h2>
        
        @if($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($posts as $post)
                    <div class="scroll-reveal bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-2">
                        <div class="p-6">
                            <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-xs font-semibold">
                                {{ $post->category }}
                            </span>
                            <h3 class="text-xl font-bold text-gray-800 mt-3 mb-3 hover:text-indigo-600 transition">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($post->excerpt, 100) }}</p>
                            <div class="flex items-center justify-between text-xs text-gray-500 mb-4 pb-4 border-b">
                                <span>📅 {{ $post->published_at->format('M d, Y') }}</span>
                                <span>⏱️ {{ $post->reading_time }}</span>
                            </div>
                            <a href="{{ route('blog.show', $post->slug) }}"
                               class="inline-flex items-center text-indigo-600 hover:text-purple-600 font-semibold transition group">
                                Read Article
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="h-2 bg-gradient-to-r from-indigo-600 to-purple-600"></div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        @else
            <div class="bg-gray-100 border-l-4 border-indigo-600 text-gray-700 p-6 rounded text-center">
                <p class="text-lg font-semibold">No blog posts yet</p>
                <p class="text-sm mt-2">Check back soon for updates!</p>
            </div>
        @endif
    </div>
</div>
@endsection