@extends('layouts.public')

@section('title', $post->title)

@section('content')
<div class="page-content">
    {{-- Breadcrumbs --}}
    <x-breadcrumbs :items="[
        ['label' => 'Home', 'url' => '/home'],
        ['label' => 'Blog', 'url' => route('blog.public')],
        ['label' => $post->title, 'url' => '#']
    ]" />

    {{-- Article Header --}}
    <article class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg p-8 md:p-12 mb-8 animate-[fadeIn_0.6s_ease-out]">
            {{-- Category & Featured Badge --}}
            <div class="flex items-center gap-2 mb-4">
                <span class="bg-indigo-100 text-indigo-800 px-4 py-2 rounded-full text-sm font-semibold">
                    {{ $post->category }}
                </span>
                @if($post->is_featured)
                    <span class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full text-sm font-semibold">
                        ⭐ Featured
                    </span>
                @endif
            </div>

            {{-- Title --}}
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6 leading-tight">
                {{ $post->title }}
            </h1>

            {{-- Meta Info --}}
            <div class="flex flex-wrap items-center gap-6 text-sm text-gray-600 mb-8 pb-8 border-b-2 border-gray-200">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="font-semibold">{{ $post->author->name }}</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>{{ $post->published_at->format('F d, Y') }}</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ $post->reading_time }}</span>
                </div>
            </div>

            {{-- Excerpt --}}
            @if($post->excerpt)
                <div class="bg-gradient-to-r from-indigo-50 to-purple-50 border-l-4 border-indigo-600 p-6 rounded-lg mb-8">
                    <p class="text-lg text-gray-700 italic leading-relaxed">
                        {{ $post->excerpt }}
                    </p>
                </div>
            @endif

            {{-- Content --}}
            <div class="prose prose-lg max-w-none">
                <div class="text-gray-700 leading-relaxed space-y-4">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>

            {{-- Share Section --}}
            <div class="mt-12 pt-8 border-t-2 border-gray-200">
                <p class="text-sm font-semibold text-gray-600 mb-4">Share this article:</p>
                <div class="flex gap-3">
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->url()) }}" 
                       target="_blank"
                       class="bg-blue-400 hover:bg-blue-500 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                        </svg>
                        Twitter
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($post->title) }}" 
                       target="_blank"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                        </svg>
                        LinkedIn
                    </a>
                </div>
            </div>
        </div>

        {{-- Related Posts --}}
        @if($relatedPosts->count() > 0)
            <div class="mt-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-8">Related Articles</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedPosts as $related)
                        <div class="scroll-reveal bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-2">
                            <div class="p-6">
                                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ $related->category }}
                                </span>
                                <h3 class="text-lg font-bold text-gray-800 mt-3 mb-2 hover:text-indigo-600 transition">
                                    <a href="{{ route('blog.show', $related->slug) }}">{{ $related->title }}</a>
                                </h3>
                                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($related->excerpt, 80) }}</p>
                                <a href="{{ route('blog.show', $related->slug) }}" 
                                   class="inline-flex items-center text-indigo-600 hover:text-purple-600 font-semibold text-sm transition group">
                                    Read More
                                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                            <div class="h-2 bg-gradient-to-r from-indigo-600 to-purple-600"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Back to Blog Link --}}
        <div class="mt-12 text-center">
            <a href="{{ route('blog.public') }}" 
               class="inline-flex items-center bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Blog
            </a>
        </div>
    </article>
</div>
@endsection